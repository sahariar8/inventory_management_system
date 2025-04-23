<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function AllInvoice(){
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.index',compact('allData'));
    }

    public function AddInvoice(){

        $category = Category::all();
        $customer = Customer::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if($invoice_data == null){
            $first_reg = '0';
            $invoice_no = $first_reg + 1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoice_no = $invoice_data + 1;    
        }
        $date = date('Y-m-d');
        return view('backend.invoice.add',compact('category','customer','invoice_no','date'));
    }

    public function StoreInvoice(Request $request)
    {
        if ($request->category_id == null) {

            $notification = array(
             'message' => 'Sorry you do not select any item', 
             'alert-type' => 'error'
         );
         return redirect()->back( )->with($notification);
         } else{
            if ($request->paid_amount > $request->estimated_amount) {
    
               $notification = array(
            'message' => 'Sorry Paid Amount is Maximum the total price', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    
            } else {
    
        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = date('Y-m-d',strtotime($request->date));
        $invoice->description = $request->description;
        $invoice->status = '0';
        $invoice->created_by = Auth::user()->id; 
    
        DB::transaction(function() use($request,$invoice){
            if ($invoice->save()) {
               $count_category = count($request->category_id);
               for ($i=0; $i < $count_category ; $i++) { 
    
                  $invoice_details = new InvoiceDetails();
                  $invoice_details->date = date('Y-m-d',strtotime($request->date));
                  $invoice_details->invoice_id = $invoice->id;
                  $invoice_details->category_id = $request->category_id[$i];
                  $invoice_details->product_id = $request->product_id[$i];
                  $invoice_details->selling_qty = $request->selling_qty[$i];
                  $invoice_details->unit_price = $request->unit_price[$i];
                  $invoice_details->selling_price = $request->selling_price[$i];
                  $invoice_details->status = '0'; 
                  $invoice_details->save(); 
               }
    
                if ($request->customer_id == '0') {
                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->mobile_no = $request->mobile_no;
                    $customer->email = $request->email;
                    $customer->save();
                    $customer_id = $customer->id;
                } else{
                    $customer_id = $request->customer_id;
                } 
    
                $payment = new Payment();
                $payment_details = new PaymentDetails();
    
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;
    
                if ($request->paid_status == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = '0';
                    $payment_details->current_paid_amount = $request->estimated_amount;
                } elseif ($request->paid_status == 'full_due') {
                    $payment->paid_amount = '0';
                    $payment->due_amount = $request->estimated_amount;
                    $payment_details->current_paid_amount = '0';
                }elseif ($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
                }
                $payment->save();
    
                $payment_details->invoice_id = $invoice->id; 
                $payment_details->date = date('Y-m-d',strtotime($request->date));
                $payment_details->save(); 
            } 
    
                }); 
    
            } // end else 
        }
    
         $notification = array(
            'message' => 'Invoice Data Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending')->with($notification);  
    }

    public function InvoicePending()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.pending',compact('allData'));
    }

    public function DeleteInvoice($id)
    {
        Invoice::findOrFail($id)->delete();
        InvoiceDetails::where('invoice_id',$id)->delete();
        Payment::where('invoice_id',$id)->delete();
        PaymentDetails::where('invoice_id',$id)->delete();

        $notification = array(
            'message' => 'Invoice Data Deleted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
       
    }

    public function InvoiceApprove($id)
    {
        
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        $payment = payment::where('invoice_id',$id)->first();
        
        return view('backend.invoice.approve',compact('invoice','payment'));
    }

    public function ApprovalStore(Request $request,$id)
    {
       
        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetails::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){

                $notification = array(
                    'message' => 'Sorry you approve Maximum Value',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification); 
            }
        } // End foreach 

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction(function() use($request,$invoice,$id){
            foreach($request->selling_qty as $key => $val){
             $invoice_details = InvoiceDetails::where('id',$key)->first();
             $product = Product::where('id',$invoice_details->product_id)->first();
             $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
             $product->save();
            } // end foreach

            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approve Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending')->with($notification);
    }

    public function PrintInvoiceList()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.print',compact('allData'));
    }

    public function PrintInvoice($id)
    {
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        $payment = payment::where('invoice_id',$id)->first();
        
        return view('backend.pdf.invoice_pdf',compact('invoice','payment'));
        
    }
}