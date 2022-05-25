<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        return view('loans.history', [
            'loans' => Auth::user()->guest->loans->sortBy('created_at')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inventory $inventory)
    {
        return view('loans.create', [
            'inventory' => $inventory->first(),
        ]);
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
            'inventory_id'  => 'required',
            'item_code'     => 'required',
            'name'          => 'required',
            'start'         => 'required',
            'end'           => 'required',
        ]);

        if(count(Inventory::find($request->inventory_id)->loans->where('status', 'not returned'))) {
            return back()->with('fail', 'Maaf barang tidak tersedia');
        }

        Loan::create([
            'guest_id'      => Auth::user()->guest->id,
            'inventory_id'  => $request->inventory_id,
            'start'         => $request->start,
            'end'           => $request->end,
        ]);

        return redirect('/loans/history')->with('success', 'Sukses mengajukan peminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
