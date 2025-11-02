<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\AdminController;

Route::prefix('admin')->name('admin.')->middleware('frontend.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->middleware('frontend.role:admin')->name('users');
    Route::get('/lokets', [AdminController::class, 'lokets'])->name('lokets');
    Route::get('/antrians', [AdminController::class, 'antrians'])->middleware('frontend.role:admin,petugas')->name('antrians');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
});
