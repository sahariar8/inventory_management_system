<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.index', compact('products'));
        
    }
    
    public function AddProduct()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('backend.product.add', compact('suppliers', 'categories', 'units'));
   
    }
    
    public function StoreProduct(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'name' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $data['created_by'] = auth()->user()->id;
        Product::create($data);
        
        $notification = array(
            'message' => 'Product added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    }

    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('backend.product.edit', compact('product', 'suppliers', 'categories', 'units'));
    }

    public function UpdateProduct(Request $request)
    {

       
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'name' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $data['updated_by'] = auth()->user()->id;
        $product = Product::findOrFail($request->id);
        $product->update($data);
        
        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    }
    public function DeleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    }
    public function ProductDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.details', compact('product'));
    }
    public function ProductStock()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock', compact('products'));
    }
    public function ProductStockReport()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report', compact('products'));
    }
    public function ProductStockReportPdf()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_pdf', compact('products'));
    }
    public function ProductStockReportExcel()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_excel', compact('products'));
    }
    public function ProductStockReportCsv()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_csv', compact('products'));
    }
    public function ProductStockReportPrint()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_print', compact('products'));
    }
    public function ProductStockReportEmail()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_email', compact('products'));
    }
    public function ProductStockReportSms()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_sms', compact('products'));
    }
    public function ProductStockReportPushNotification()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_push_notification', compact('products'));
    }
    public function ProductStockReportWebhook()
    {
        $products = Product::latest()->get();
        return view('backend.product.stock_report_webhook', compact('products'));
    }
}