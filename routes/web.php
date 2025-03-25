<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
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

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout','logout')->name('admin.logout');
    Route::get('/profile','profile')->name('profile');
    Route::get('/profile/edit','editProfile')->name('profile.edit');
    Route::post('/profile/update','updateProfile')->name('profile.update');
    Route::get('change/password','changePassword')->name('change.password');
    Route::post('change/password','updatePassword')->name('update.password');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('supplier/all','AllSupplier')->name('supplier.all');
    Route::get('supplier/add','AddSupplier')->name('supplier.add');
    Route::post('supplier/store','StoreSupplier')->name('supplier.store');
    Route::get('supplier/edit/{id}','EditSupplier')->name('supplier.edit');
    Route::post('supplier/update','UpdateSupplier')->name('supplier.update');
    Route::get('supplier/delete/{id}','DeleteSupplier')->name('supplier.delete');
    
});

require __DIR__.'/auth.php';