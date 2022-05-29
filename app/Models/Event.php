<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'responsible', 'start', 'end', 'description'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
