<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function guest() {
        return view('dashboard');
    }

    public function staff() {
        return view('staff.dashboard');
    }
}
