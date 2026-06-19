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
            $table->id('id_pengajar');
            $table->string('nik', 20);
            $table->foreign('nik')->references('nik')->on('dosen')->onDelete('cascade');
            $table->string('kode_mk', 10);
            $table->foreign('kode_mk')
            ->references('kode_mk')
            ->on('mata_kuliah')
            ->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')
            ->references('id_kelas')
            ->on('kelas')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')
            ->references('id_tahun_ajaran')
            ->on('tahun_ajaran')
            ->onDelete('cascade');
            
            $table->integer('semester');
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
