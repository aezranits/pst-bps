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
        'petugas_pst',
        'in_progress_at',
        'done_at',
        'duration',
        'bukti_identitas_diri_path',
        'dokumen_permintaan_informasi_publik_path',
    ];

    protected $casts = [
        'tujuan_kunjungan' => 'array',
        'in_progress_at' => 'datetime',
        'done_at' => 'datetime',
        'duration' => 'integer',
    ];

    public function petugasPst()
    {
        return $this->belongsTo(User::class, 'petugas_pst')->role('pst');
    }

    // Relasi ke tabel Province
    public function provinsi()
    {
        return $this->belongsTo(Province::class);
    }

    // Relasi ke tabel Regency
    public function kota()
    {
        return $this->belongsTo(Regency::class);
    }

    // Method untuk menghitung durasi dari inProgress ke done
    public function getDurationAttribute()
    {
        if ($this->in_progress_at && $this->done_at) {
            return $this->done_at->diffForHumans($this->in_progress_at, true);
        }

        return null;
    }
}

