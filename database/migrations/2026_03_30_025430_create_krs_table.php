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
        Schema::create('krs', function (Blueprint $table) {
    $table->id('id_krs');
    $table->string('nim', 20);
    $table->foreign('nim')
          ->references('nim')
          ->on('mahasiswa')
          ->onDelete('cascade');
    $table->unsignedBigInteger('id_tahun_ajaran');
    $table->foreign('id_tahun_ajaran')
          ->references('id_tahun_ajaran')
          ->on('tahun_ajaran')
          ->onDelete('cascade');
    $table->enum('status', ['draft','diajukan','disetujui','ditolak'])->default('draft');
    $table->enum('status_wali', ['pending','disetujui','ditolak'])
              ->default('pending');
    $table->string('nuptk_wali', 20)->nullable();
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
