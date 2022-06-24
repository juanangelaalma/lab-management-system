<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestbookController extends Controller
{
    public function history() {
        $user_id = Auth::guard('api')->user();

        return response()->json(["error" => false, "message" => "fetching history data successfully", "data" => $user_id->guest->guestbook]);
    }
}
