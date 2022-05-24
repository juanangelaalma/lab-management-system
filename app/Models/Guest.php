<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reg_number',
        'name',
        'birth_date',
        'birth_place',
        'address',
        'major',
        'study_program',
        'class'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function guestbook() {
        return $this->hasMany(Guestbook::class)->latest();
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }

    public function loans() {
        return $this->hasMany(Loan::class);
    }
}
