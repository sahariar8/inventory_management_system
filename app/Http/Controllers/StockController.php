<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StockController extends Controller
{
    public function stockReport()
    {
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.stock.stock_report',compact('allData'));
    }

    public function StockReportPdf()
    {
        
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.pdf.stock_report_pdf',compact('allData'));
    }

    public function downloadPDF()
    {
        
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = Pdf::loadView('backend.stock.stock_report_download', compact('allData'))->setPaper('a4', 'landscape');
        return $pdf->download('stock-report.pdf');
    }

    

    public function StockSupplierWise()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('backend.stock.supplier_product_wise_report',compact('suppliers','categories'));
    }

    public function SupplierWisePdf(Request $request){
 
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        return view('backend.pdf.supplier_wise_report_pdf',compact('allData'));

    } 

    public function SupplierWisePdfDownload(Request $request){
 
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
      
        $pdf = Pdf::loadView('backend.supplier.supplier_wise_report', compact('allData'))->setPaper('a4', 'landscape');
        return $pdf->download('supplier-wise-report.pdf');

    } 

    public function ProductWisePdf(Request $request){
 
        $product = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
        return view('backend.pdf.product_wise_report_pdf',compact('product'));
    }
}