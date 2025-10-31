<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\DisplayController;

Route::prefix('display')->name('display.')->group(function () {
    Route::get('/kiosk', [DisplayController::class, 'kiosk'])->name('kiosk');
    Route::get('/overview', [DisplayController::class, 'overview'])->name('overview');
    Route::get('/loket/{id}', [DisplayController::class, 'loket'])->name('loket');
});
