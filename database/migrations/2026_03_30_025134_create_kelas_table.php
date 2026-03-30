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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->enum('nama_kelas', ['A', 'B', 'C', 'D', 'E']);
            $table->enum('kategori', ['Pagi', 'Malam']);
            $table->string('nidn_wali')->nullable()->unique();
            $table->foreign('nidn_wali')->references('nidn')->on('dosen')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
