<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\AuthController;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');
    Route::get('/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
