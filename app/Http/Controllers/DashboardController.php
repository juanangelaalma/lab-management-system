<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Inventory;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getCountMonthUser($month) {
        $year = date("Y");
        $guestId = Auth::user()->guest->id;
        return DB::selectOne("select count(id) as total from guestbooks where month(start)=$month AND year(start)=$year AND guest_id=$guestId");
    }

    private function getCountMonthStaff($month) {
        $year = date("Y");
        return DB::selectOne("select count(id) as total from guestbooks where month(start)=$month AND year(start)=$year");
    }

    private function getCountAllMonthUser() {
        $month = [];
        for($i=1; $i<=12; $i++) {
            $count = $this->getCountMonthUser($i);
            array_push($month, $count->total);
        }
        return $month;
    }

    private function getCountAllMonthStaff() {
        $month = [];
        for($i=1; $i<=12; $i++) {
            $count = $this->getCountMonthStaff($i);
            array_push($month, $count->total);
        }
        return $month;
    }

    public function guest() {
        return view('dashboard',[
            'name'            => Auth::user()->guest->name,
            'loans_total'     => Auth::user()->guest->loans->count(),
            'guestbook_total' => Auth::user()->guest->guestbook->count(),
            'months'          => $this->getCountAllMonthUser()
        ]);
    }

    public function staff() {
        // dd(Loan::latest()->limit(5)->get());
        return view('staff.dashboard', [
            'months'          => $this->getCountAllMonthStaff(),
            'guestbooks'      => Guestbook::whereDate("start", date("Y-m-d"))->get(),
            'inventories'     => Inventory::latest()->limit(5)->get(),
            'loans'           => Loan::latest()->limit(5)->get()
        ]);
    }
}
