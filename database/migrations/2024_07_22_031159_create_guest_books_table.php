<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestBooksTable extends Migration
{
    public function up()
    {
        Schema::create('guest_books', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->integer('usia');
            $table->string('pekerjaan');
            $table->string('jurusan')->nullable();
            $table->string('asal_universitas')->nullable();
            $table->string('asal')->nullable();
            $table->string('asal_universitas_lembaga')->nullable();
            $table->string('organisasi_nama_perusahaan_kantor')->nullable();
            $table->string('no_hp');
            $table->string('email');
            $table->string('asal_kota');
            $table->json('tujuan_kunjungan');
            $table->string('tujuan_kunjungan_lainnya')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guest_books');
    }
}

