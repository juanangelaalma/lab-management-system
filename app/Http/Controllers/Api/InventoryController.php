<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index() {
        return response()->json(["data" => Inventory::all(), "error" => false, "message" => "fetching inventories data successfully"]);
    }
}
