<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $profile = Auth::user()->guest;
        
        if(Auth::user()->role == 'staff') {
            return view('components.navbar_staff');
        }

        $profile->role = 'guest';
        return view('components.navbar', ['profile' => $profile]);
    }
}
