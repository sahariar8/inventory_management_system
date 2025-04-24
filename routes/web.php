<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout','logout')->name('admin.logout');
        Route::get('/profile','profile')->name('profile');
        Route::get('/profile/edit','editProfile')->name('profile.edit');
        Route::post('/profile/update','updateProfile')->name('profile.update');
        Route::get('change/password','changePassword')->name('change.password');
        Route::post('change/password','updatePassword')->name('update.password');
    });
    
    // Supplier Routes
    
    Route::controller(SupplierController::class)->group(function () {
        Route::get('supplier/all','AllSupplier')->name('supplier.all');
        Route::get('supplier/add','AddSupplier')->name('supplier.add');
        Route::post('supplier/store','StoreSupplier')->name('supplier.store');
        Route::get('supplier/edit/{id}','EditSupplier')->name('supplier.edit');
        Route::post('supplier/update','UpdateSupplier')->name('supplier.update');
        Route::get('supplier/delete/{id}','DeleteSupplier')->name('supplier.delete');
        
    });
    
    // Customer Routes
    
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customer/all','AllCustomer')->name('customer.all');
        Route::get('customer/add','AddCustomer')->name('customer.add');
        Route::post('customer/store','StoreCustomer')->name('customer.store');
        Route::get('customer/edit/{id}','EditCustomer')->name('customer.edit');
        Route::post('customer/update','UpdateCustomer')->name('customer.update');
        Route::get('customer/delete/{id}','DeleteCustomer')->name('customer.delete');

        Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');
        Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');
        Route::get('/customer/edit/invoice/{id}', 'CustomerEditInvoice')->name('customer.edit.invoice');
        Route::post('/customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');
        Route::get('/customer/invoice/details/{id}', 'CustomerInvoiceDetails')->name('customer.invoice.details');
        Route::get('/paid/customer', 'PaidCustomer')->name('paid.customer');
        Route::get('/paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');

        Route::get('/customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
        Route::get('/customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
        Route::get('/customer/wise/paid/report', 'CustomerWisePaidReport')->name('customer.wise.paid.report');
        
    });
    
    // Unit Routes
    
    Route::controller(UnitController::class)->group(function () {
        Route::get('unit/all','AllUnit')->name('unit.all');
        Route::get('unit/add','AddUnit')->name('unit.add');
        Route::post('unit/store','StoreUnit')->name('unit.store');
        Route::get('unit/edit/{id}','EditUnit')->name('unit.edit');
        Route::post('unit/update','UpdateUnit')->name('unit.update');
        Route::get('unit/delete/{id}','DeleteUnit')->name('unit.delete');
        
    });
    
    // Category Routes
    
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category/all','AllCategory')->name('category.all');
        Route::get('category/add','AddCategory')->name('category.add');
        Route::post('category/store','StoreCategory')->name('category.store');
        Route::get('category/edit/{id}','EditCategory')->name('category.edit');
        Route::post('category/update','UpdateCategory')->name('category.update');
        Route::get('category/delete/{id}','DeleteCategory')->name('category.delete');
        
    });
    
    // Product Routes
    
    Route::controller(ProductController::class)->group(function () {
        Route::get('product/all','AllProduct')->name('product.all');
        Route::get('product/add','AddProduct')->name('product.add');
        Route::post('product/store','StoreProduct')->name('product.store');
        Route::get('product/edit/{id}','EditProduct')->name('product.edit');
        Route::post('product/update','UpdateProduct')->name('product.update');
        Route::get('product/delete/{id}','DeleteProduct')->name('product.delete');
        
    });
    
    
    // Purchase Routes
    
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('purchase/all','AllPurchase')->name('purchase.all');
        Route::get('purchase/add','AddPurchase')->name('purchase.add');
        Route::post('purchase/store','StorePurchase')->name('purchase.store');
        Route::get('purchase/pending','PurchasePending')->name('purchase.pending');
        Route::get('purchase/approve/{id}','PurchaseApprove')->name('purchase.approve');
        Route::get('purchase/delete/{id}','DeletePurchase')->name('purchase.delete');
        Route::get('daily/purchase/report','DailyPurchaseReport')->name('daily.purchase.report');
        Route::get('daily/purchase/pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');
        
    });
    
    // Invoice Routes
    
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('invoice/all','AllInvoice')->name('invoice.all');
        Route::get('invoice/add','AddInvoice')->name('invoice.add');
        Route::post('invoice/store','StoreInvoice')->name('invoice.store');
        Route::get('invoice/pending','InvoicePending')->name('invoice.pending');
        Route::get('invoice/approve/{id}','InvoiceApprove')->name('invoice.approve');
        Route::get('invoice/delete/{id}','DeleteInvoice')->name('invoice.delete');
        Route::post('/approval/store/{id}', 'ApprovalStore')->name('approval.store');
        Route::get('/print/invoice/list', 'PrintInvoiceList')->name('print.invoice.list');
        Route::get('/print/invoice/{id}', 'PrintInvoice')->name('print.invoice');
        Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    });
    
    
    // Stock Routes
        
    Route::controller(StockController::class)->group(function () {
        Route::get('stock/report','stockReport')->name('stock.report');
        Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf'); 
        Route::get('/stock/supplier-wise', 'StockSupplierWise')->name('stock.supplier.wise'); 
        Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
       
    });
  
});



// Default Routes

Route::controller(DefaultController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('/get-category','getCategory')->name('get.category');
    Route::get('/get-product','getProduct')->name('get.product');
    Route::get('/get-product-stock','getProductStock')->name('get.product.stock');
    
});



require __DIR__.'/auth.php';