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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nim', 20)->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama', 100);
            $table->integer('semester');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_kelas');
            $table->timestamps();
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
