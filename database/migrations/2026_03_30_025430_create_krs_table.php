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
    $table->string('nim');
    $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajaran');
    $table->enum('status', ['draft','diajukan','disetujui','ditolak'])->default('draft');
    $table->enum('status_wali', ['pending','disetujui','ditolak'])
              ->default('pending');
    $table->string('nidn_wali')->nullable();
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
