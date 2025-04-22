<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('/admin/logout','logout')->name('admin.logout');
    Route::get('/profile','profile')->name('profile');
    Route::get('/profile/edit','editProfile')->name('profile.edit');
    Route::post('/profile/update','updateProfile')->name('profile.update');
    Route::get('change/password','changePassword')->name('change.password');
    Route::post('change/password','updatePassword')->name('update.password');
});

// Supplier Routes

Route::controller(SupplierController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('supplier/all','AllSupplier')->name('supplier.all');
    Route::get('supplier/add','AddSupplier')->name('supplier.add');
    Route::post('supplier/store','StoreSupplier')->name('supplier.store');
    Route::get('supplier/edit/{id}','EditSupplier')->name('supplier.edit');
    Route::post('supplier/update','UpdateSupplier')->name('supplier.update');
    Route::get('supplier/delete/{id}','DeleteSupplier')->name('supplier.delete');
    
});

// Customer Routes

Route::controller(CustomerController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('customer/all','AllCustomer')->name('customer.all');
    Route::get('customer/add','AddCustomer')->name('customer.add');
    Route::post('customer/store','StoreCustomer')->name('customer.store');
    Route::get('customer/edit/{id}','EditCustomer')->name('customer.edit');
    Route::post('customer/update','UpdateCustomer')->name('customer.update');
    Route::get('customer/delete/{id}','DeleteCustomer')->name('customer.delete');
    
});

// Unit Routes

Route::controller(UnitController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('unit/all','AllUnit')->name('unit.all');
    Route::get('unit/add','AddUnit')->name('unit.add');
    Route::post('unit/store','StoreUnit')->name('unit.store');
    Route::get('unit/edit/{id}','EditUnit')->name('unit.edit');
    Route::post('unit/update','UpdateUnit')->name('unit.update');
    Route::get('unit/delete/{id}','DeleteUnit')->name('unit.delete');
    
});

// Category Routes

Route::controller(CategoryController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('category/all','AllCategory')->name('category.all');
    Route::get('category/add','AddCategory')->name('category.add');
    Route::post('category/store','StoreCategory')->name('category.store');
    Route::get('category/edit/{id}','EditCategory')->name('category.edit');
    Route::post('category/update','UpdateCategory')->name('category.update');
    Route::get('category/delete/{id}','DeleteCategory')->name('category.delete');
    
});

// Product Routes

Route::controller(ProductController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('product/all','AllProduct')->name('product.all');
    Route::get('product/add','AddProduct')->name('product.add');
    Route::post('product/store','StoreProduct')->name('product.store');
    Route::get('product/edit/{id}','EditProduct')->name('product.edit');
    Route::post('product/update','UpdateProduct')->name('product.update');
    Route::get('product/delete/{id}','DeleteProduct')->name('product.delete');
    
});


// Purchase Routes

Route::controller(PurchaseController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('purchase/all','AllPurchase')->name('purchase.all');
    Route::get('purchase/add','AddPurchase')->name('purchase.add');
    Route::post('purchase/store','StorePurchase')->name('purchase.store');
    Route::get('purchase/pending','PurchasePending')->name('purchase.pending');
    Route::get('purchase/approve/{id}','PurchaseApprove')->name('purchase.approve');
    
    Route::get('purchase/delete/{id}','DeletePurchase')->name('purchase.delete');
    
});

// Invoice Routes

Route::controller(InvoiceController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('invoice/all','AllInvoice')->name('invoice.all');
    Route::get('invoice/add','AddInvoice')->name('invoice.add');
    Route::post('invoice/store','StoreInvoice')->name('invoice.store');
    Route::get('invoice/pending','InvoicePending')->name('invoice.pending');
    Route::get('invoice/approve/{id}','InvoiceApprove')->name('invoice.approve');
    Route::get('invoice/delete/{id}','DeleteInvoice')->name('invoice.delete');
    
});

// Default Routes

Route::controller(DefaultController::class)->middleware(['auth','verified'])->group(function () {
    Route::get('/get-category','getCategory')->name('get.category');
    Route::get('/get-product','getProduct')->name('get.product');
    Route::get('/get-product-stock','getProductStock')->name('get.product.stock');
    
});



require __DIR__.'/auth.php';