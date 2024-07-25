<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_book_id',
        'status',
        'response',
    ];

    public function guestBook()
    {
        return $this->belongsTo(GuestBook::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

}

