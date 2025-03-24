<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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

require __DIR__.'/auth.php';