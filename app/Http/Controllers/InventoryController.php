<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $inventories = Inventory::all();
        return view('inventories.list', ['inventories' => $inventories]);
    }

    /**
     * Display a table of the resources for staff
     * @return \Illuminate\Http\Response
     */
    public function table()
    {
        return view('staff.inventories.table', [
            'inventories' => Inventory::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.inventories.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories_id = Category::where('id', '>', 0)->pluck('id')->all();
        $categories_id = implode(',', $categories_id);
        $request->validate([
            'item_code'     => 'required|unique:inventories',
            'name'          => 'required',
            'category_id'   => "required|in:$categories_id",
            'condition'     => 'required|in:good,bad',
        ]);

        Inventory::create([
            'item_code' => $request->item_code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'condition' => $request->condition,
            'description' => $request->description
        ]);

        return redirect(route('staff.inventories.table'))->with('success', 'Berhasil menambahkan inventori!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('staff.inventories.edit', [
            'inventory' => $inventory,
            'categories'=> Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryRequest  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Inventory $inventory, Request $request)
    {
        $categories_id = Category::where('id', '>', 0)->pluck('id')->all();
        $categories_id = implode(',', $categories_id);
        
        request()->validate([
            'item_code'     => ['required', Rule::unique('inventories', 'item_code')->ignore($inventory)],
            'name'          => 'required',
            'category_id'   => "required|in:$categories_id",
            'condition'     => 'required|in:good,bad',
        ]);

        $inventory->update([
            'item_code'     => $request->item_code,
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'condition'     => $request->condition,
        ]);

        return redirect(route('staff.inventories.table'))->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return back()->with('success', 'Berhasil menghapus item!');
    }
}
