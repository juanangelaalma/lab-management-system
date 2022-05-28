<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['guest_id', 'inventory_id', 'start', 'end', 'status'];

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }

    public function guest() {
        return $this->belongsTo(Guest::class);
    }
}
