<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function AllInvoice(){
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->get();
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
        return view('backend.invoice.add',compact('category','customer','invoice_no'));
    }

    public function StoreInvoice(Request $request)
    {
        if ($request->category_id == null) {

            $notification = array(
             'message' => 'Sorry you do not select any item', 
             'alert-type' => 'error'
         );
         return redirect()->back( )->with($notification);
         } else {
     
             $count_category = count($request->category_id);
             for ($i=0; $i < $count_category; $i++) { 
                 $purchase = new Invoice();
                 $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                 $purchase->purchase_no = $request->purchase_no[$i];
                 $purchase->supplier_id = $request->supplier_id[$i];
                 $purchase->category_id = $request->category_id[$i];
     
                 $purchase->product_id = $request->product_id[$i];
                 $purchase->buying_qty = $request->buying_qty[$i];
                 $purchase->unit_price = $request->unit_price[$i];
                 $purchase->buying_price = $request->buying_price[$i];
                 $purchase->description = $request->description[$i];
     
                 $purchase->created_by = Auth::user()->id;
                 $purchase->status = '0';
                 $purchase->save();
             } // end foreach
         } // end else 
     
         $notification = array(
             'message' => 'Data Save Successfully', 
             'alert-type' => 'success'
         );
         return redirect()->route('purchase.all')->with($notification); 
    }
}