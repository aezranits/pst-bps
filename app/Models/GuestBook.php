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
        'provinsi_id',
        'kota_id',
        'alamat',
        'tujuan_kunjungan',
        'tujuan_kunjungan_lainnya',
        'status',
        'petugas_pst'
    ];

    protected $casts = [
        'tujuan_kunjungan' => 'array',
    ];

    public function petugasPst()
    {
        return $this->belongsTo(User::class, 'petugas_pst')->role('pst');
    }

    // Relasi ke tabel Province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Relasi ke tabel Regency
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}

