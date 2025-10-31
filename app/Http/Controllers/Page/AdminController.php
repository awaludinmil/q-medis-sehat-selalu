<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('pages.admin.dashboard');
    }

    public function users(): View
    {
        return view('pages.admin.users');
    }

    public function lokets(): View
    {
        return view('pages.admin.lokets');
    }

    public function antrians(): View
    {
        return view('pages.admin.antrians');
    }
}
