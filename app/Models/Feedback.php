<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'requests_id',
        'petugas_pst_id',
        'front_office_id',
        'kepuasan_petugas_pst',
        'kepuasan_petugas_front_office',
        'kepuasan_sarana_prasarana',
        'kritik_saran',
    ];

    public function requests()
    {
        return $this->belongsTo(Request::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}

