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

    public function showLoket($id): View
    {
        return view('pages.admin.loket-detail', ['loketId' => $id]);
    }

    public function profile(): View
    {
        return view('pages.admin.profile');
    }
}
