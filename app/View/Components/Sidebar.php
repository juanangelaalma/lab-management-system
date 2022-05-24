<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active = "";
    public function __construct($active = "dashboard")
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = Auth::user();

        if($user->role == 'staff') {
            return view('components.sidebar_staff');
        }

        return view('components.sidebar');
    }
}
