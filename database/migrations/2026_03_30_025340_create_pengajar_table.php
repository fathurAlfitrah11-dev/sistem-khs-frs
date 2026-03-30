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
        Schema::create('pengajar', function (Blueprint $table) {
            $table->id();
            $table->string('nidn');
            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id');
            $table->foreignId('tahun_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->integer('semester');
            
    // deadline input nilai
            $table->date('deadline_nilai')->nullable();
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajar');
    }
};
