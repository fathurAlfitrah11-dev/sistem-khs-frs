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
            $table->id();

    $table->string('nim');
    $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
    $table->foreignId('pengajar_id')->constrained('pengajar')->onDelete('cascade');
    $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');

    $table->enum('status_krs', ['pending','disetujui','ditolak']);
    $table->enum('status_wali', ['pending','disetujui','ditolak'])->default('pending');

    $table->enum('nilai', ['A','B','C','D','E'])->nullable();

    $table->timestamps();
    $table->unique(['nim', 'pengajar_id', 'tahun_ajaran_id']);
    $table->index('nim');
    $table->index('pengajar_id');
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
