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
            $table->string('nama_lengkap')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->integer('usia')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('asal_universitas')->nullable();
            $table->string('asal')->nullable();
            $table->string('asal_universitas_lembaga')->nullable();
            $table->string('organisasi_nama_perusahaan_kantor')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('asal_kota')->nullable();
            $table->json('tujuan_kunjungan')->nullable();
            $table->string('tujuan_kunjungan_lainnya')->nullable();
            $table->foreignId('petugas_pst_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guest_books');
    }
}

