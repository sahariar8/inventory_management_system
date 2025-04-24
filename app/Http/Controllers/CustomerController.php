<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;




class CustomerController extends Controller
{
    public function AllCustomer()
    {
        $allCustomer = Customer::latest()->get();
        return view('backend.customer.index',compact('allCustomer'));
    }

    public function AddCustomer()
    {
        return view('backend.customer.add');
    }

    public function StoreCustomer(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11|unique:customers,mobile_no',
            'address'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',  
        ]);
        $image = $request->file('image');

        if (isset($image)) {
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $savePath = public_path('upload/customer/' . $imageName);
        
            $image = ImageManager::gd()->read($image);
            $image->resize(300, 200);
            $image->save($savePath); 
        
            $data['image'] = 'upload/customer/' . $imageName;
        }
        
        $data['created_by'] = Auth::id();
        
        Customer::create($data);
        $notification = array(
            'message' => 'Customer added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }

    public function EditCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit',compact('customer'));
    }
    
    public function UpdateCustomer(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'mobile_no'=>'required|digits:11',
            'address'=>'required',
        ]);
        
        
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        if($request->hasFile('image')){
            if(file_exists($customer->image)){
                unlink($customer->image);
            }
            $image = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $savePath = public_path('upload/customer/' . $imageName);
            $image = ImageManager::gd()->read($image);
            $image->resize(300, 200);
            $image->save($savePath);
            $data['image'] = 'upload/customer/' . $imageName;
        } else {
            $data['image'] = $customer->image;
        }
        $data['updated_by'] = Auth::id();
        $customer->update($data);
        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }

    public function DeleteCustomer($id)
    {
        Customer::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function CreditCustomer(){
 
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.customer.customer_credit',compact('allData'));

    }

    public function CreditCustomerPrintPdf(){
 
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer_credit_pdf',compact('allData'));

    }

    public function CustomerEditInvoice($id){
 
        $payment = Payment::where('invoice_id',$id)->first();
        return view('backend.customer.edit_customer_invoice',compact('payment'));

    }

    public function CustomerUpdateInvoice(Request $request,$invoice_id){

        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
            'message' => 'Sorry You Paid Maximum Value', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification); 
        } else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetails();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                 $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                 $payment->due_amount = '0';
                 $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

              $notification = array(
            'message' => 'Invoice Update Successfully', 
            'alert-type' => 'success'
            );
            return redirect()->route('credit.customer')->with($notification); 

        }

    }

    public function CustomerInvoiceDetails($id){
        
        $payment = Payment::where('invoice_id',$id)->first();
        return view('backend.pdf.invoice_details_pdf',compact('payment'));
    }

    public function PaidCustomer(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.customer.paid_customer',compact('allData'));
    }

    public function PaidCustomerPrintPdf(){
 
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.pdf.customer_paid_pdf',compact('allData'));
    }

    public function CustomerWiseReport(){
 
        $customers = Customer::all();
        return view('backend.customer.customer_wise_report',compact('customers'));

    }

    public function CustomerWiseCreditReport(Request $request){
 
        $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.customer_wise_credit_pdf',compact('allData'));
   }

   public function CustomerWisePaidReport(Request $request){
 
    $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
    return view('backend.pdf.customer_wise_paid_pdf',compact('allData'));
}
}