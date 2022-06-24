<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuestbookController extends Controller
{
    public function history() {
        $user_id = Auth::guard('api')->user();

        return response()->json(["error" => false, "message" => "fetching history data successfully", "data" => $user_id->guest->guestbook]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'purpose'   => 'required|min:8',
            'start'     => 'required|date_format:H:i:s',
            'end'       => 'required|date_format:H:i:s',
        ]);

        if($validator->fails()) {
            return response()->json(["data" => [], "error" => true, "message" => $validator->errors()], 400);
        }

        $guestbook = Guestbook::create([
            'guest_id'    => Auth::guard('api')->user()->guest->id,
            'purpose'     => $request->purpose,
            'start'       => date('Y-m-d') . " $request->start",
            'end'         => date('Y-m-d') . " $request->end",
            'description' => $request->description,
        ]);

        return response()->json(["data" => $guestbook, "message" => "successfully filling out the guestbook", "error" => false], 201);
    }
}
