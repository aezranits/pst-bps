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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requests_id')->constrained()->onDelete('cascade');
            $table->foreignId('petugas_pst_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('front_office_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->integer('kepuasan_petugas_pst')->nullable();
            $table->integer('kepuasan_petugas_front_office')->nullable();
            $table->integer('kepuasan_sarana_prasarana')->nullable();
            $table->text('kritik_saran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
