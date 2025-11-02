<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\AdminController;

Route::middleware('frontend.auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->middleware('frontend.role:admin')->name('users');
    Route::get('/lokets', [AdminController::class, 'lokets'])->name('lokets');
    Route::get('/lokets/{id}', [AdminController::class, 'showLoket'])->name('lokets.show');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
});
