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
        Schema::create('mata_kuliah', function (Blueprint $table) {
           $table->id('id_mata_kuliah');
        $table->string('kode_mk', 10)->unique();
        $table->string('nama_mk', 100);
        $table->integer('sks');
        $table->unsignedBigInteger('id_prodi');
        $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');
        $table->integer('semester');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
