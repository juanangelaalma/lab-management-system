<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    use HasFactory;

    protected $fillable = ["guest_id", "purpose", "start", "end", "description"];

    public function guest() {
        return $this->belongsTo(Guest::class);
    }
}
