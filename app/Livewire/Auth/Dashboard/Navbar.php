<?php

namespace App\Livewire\Auth\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        Auth::logout();

        return redirect()->to(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.dashboard.navbar')->with([
            'user' => Auth::user(),
        ]);
    }
}
