<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Inventory;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function valueToArray($data) {
        $month = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach($data as $res) {
            $month[$res->month - 1] = $res->total;
        }
        return $month;
    }

    public function guest() {
        return view('dashboard',[
            'name'            => Auth::user()->guest->name,
            'loans_total'     => Auth::user()->guest->loans->count(),
            'guestbook_total' => Auth::user()->guest->guestbook->count(),
            'months'          => $this->valueToArray(Guestbook::select(DB::raw('count(id) as total'), DB::raw('MONTH(start) month'))->where('guest_id', Auth::user()->guest->id)->groupBy('month')->get())
        ]);
    }

    public function staff() {
        return view('staff.dashboard', [
            'months'          => $this->valueToArray(Guestbook::select(DB::raw('count(id) as total'), DB::raw('MONTH(start) month'))->groupBy('month')->get()),
            'guestbooks'      => Guestbook::whereDate("start", date("Y-m-d"))->get(),
            'inventories'     => Inventory::latest()->limit(5)->get(),
            'loans'           => Loan::latest()->limit(5)->get()
        ]);
    }
}
