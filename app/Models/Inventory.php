<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['item_code', 'name', 'category_id', 'condition', 'description'];

    public function loans() {
        return $this->hasMany(Loan::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
