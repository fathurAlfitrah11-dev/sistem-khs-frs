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
            $table->integer('semester');
            $table->unsignedBigInteger('id_prodi');
            $table->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
                ->onDelete('cascade');
            $table->enum('nama_kelas', ['A', 'B', 'C', 'D', 'E']);
            $table->enum('kategori', ['Pagi', 'Malam']);
            $table->string('nuptk_wali', 20)->nullable()->unique();
            $table->foreign('nuptk_wali')->references('nuptk')->on('dosen')->onDelete('set null');
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
