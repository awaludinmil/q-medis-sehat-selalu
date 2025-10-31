<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/web/display.php';
require __DIR__ . '/web/auth.php';
require __DIR__ . '/web/admin.php';

Route::get('/', function () {
    return redirect()->route('display.overview');
});
