<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getCountMonth($month) {
        $year = date("Y");
        $guestId = Auth::user()->guest->id;
        return DB::selectOne("select count(id) as total from guestbooks where month(start)=$month AND year(start)=$year AND guest_id=$guestId");
    }

    private function getCountAllMonth() {
        $month = [];
        for($i=1; $i<=12; $i++) {
            $count = $this->getCountMonth($i);
            array_push($month, $count->total);
        }
        return $month;
    }
    public function guest() {
        return view('dashboard',[
            'name'            => Auth::user()->guest->name,
            'loans_total'     => Auth::user()->guest->loans->count(),
            'guestbook_total' => Auth::user()->guest->guestbook->count(),
            'months'          => $this->getCountAllMonth()
        ]);
    }

    public function staff() {
        return view('staff.dashboard');
    }
}
