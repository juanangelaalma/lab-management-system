<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Guestbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.guestbook.table', [
            'guestbook'    => Guestbook::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guestbook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'purpose'   => 'required|min:8',
            'start'     => 'required',
            'end'       => 'required',
        ]);
        
        Guestbook::create([
            'guest_id'    => Auth::user()->guest->id,
            'purpose'     => $request->purpose,
            'start'       => $request->start,
            'end'         => $request->end,
            'description' => $request->description,
        ]);
        
        return back()->with('success', 'Terima kasih telah mengisi buku tamu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function show(Guestbook $guestbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Guestbook $guestbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guestbook $guestbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guestbook $guestbook)
    {
        //
    }

    public function history() {
        $id = Auth::user()->guest->id;
        $guestbook = Guest::find($id)->guestbook;
        
        return view('guestbook.history', [
            'guestbook' => $guestbook
        ]);
    }
}
