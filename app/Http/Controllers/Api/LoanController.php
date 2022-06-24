<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function history() {
        $loans = Auth::guard('api')->user()->guest->loans;
        return response()->json(["data" => $loans, "error" => false, "message" => "fetching loans data successfully"]);
    }
}
