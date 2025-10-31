<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        session()->forget(['access_token', 'refresh_token']);
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.shared.navbar');
    }
}
