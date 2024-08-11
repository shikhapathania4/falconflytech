<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [AdminController::class, 'users'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [AdminController::class, 'orders']);
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');    ;

    Route::post('/change-user-status/{id}', [AdminController::class, 'changeUserStatus']);

    Route::get('/promotions', [AdminController::class, 'promotions']);
    Route::post('/promotions', [AdminController::class, 'createPromotion']);
    Route::delete('/promotions/{id}', [AdminController::class, 'deletePromotion']);

    Route::get('/services', [AdminController::class, 'services']);
});

require __DIR__.'/auth.php';
