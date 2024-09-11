<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback_pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->foreignId('petugas_pengaduan')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('kepuasan_petugas_pengaduan')->nullable();
            $table->integer('kepuasan_sarana_prasarana_pengaduan')->nullable();
            $table->text('kritik_saran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_pengaduans');
    }
};
