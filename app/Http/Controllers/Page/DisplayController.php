<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DisplayController extends Controller
{
    public function kiosk(): View
    {
        return view('pages.display.kiosk');
    }

    public function overview(): View
    {
        return view('pages.display.overview');
    }

    public function loket(int|string $id): View
    {
        return view('pages.display.loket', ['loketId' => $id]);
    }
}
