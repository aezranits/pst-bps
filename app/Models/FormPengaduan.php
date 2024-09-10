<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'pekerjaan',
        'no_hp',
        'email',
        'rincian_informasi',
        'tujuan_penggunaan_informasi',
        'cara_memperoleh_informasi',
        'cara_mendapatkan_salinan_informasi',
        'bukti_identitas_diri_path',
        'tanda_tangan',
    ];
}
