<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function AllPurchase()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id','desc')->get();
        return view('backend.purchase.index',compact('allData'));
    }

    public function AddPurchase()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('backend.purchase.add',compact('suppliers','units','categories'));
    }

    public function StorePurchase(Request $request)
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
                 $purchase = new Purchase();
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


    public function DeletePurchase($id)
    {
        Purchase::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Purchase Item deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PurchasePending()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.pending',compact('allData'));
    }

    public function PurchaseApprove($id){

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){
            
            Purchase::findOrFail($id)->update(['status'=>'1']);
            $notification = array(
                'message' => 'Status Approved successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('purchase.all')->with($notification);
        }
        
    }

    public function DailyPurchaseReport()
    {
        return view('backend.purchase.daily_purchase_report');
    }

    public function DailyPurchasePdf(Request $request){
 
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('backend.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));

    }

    
}