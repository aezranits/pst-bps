<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'usia',
        'pekerjaan',
        'jurusan',
        'asal_universitas',
        'asal',
        'asal_universitas_lembaga',
        'organisasi_nama_perusahaan_kantor',
        'no_hp',
        'email',
        'asal_kota',
        'tujuan_kunjungan',
        'tujuan_kunjungan_lainnya'
    ];

    protected $casts = [
        'tujuan_kunjungan' => 'array',
    ];

    public function requests()
    {
        return $this->hasOne(Request::class);
    }
}

