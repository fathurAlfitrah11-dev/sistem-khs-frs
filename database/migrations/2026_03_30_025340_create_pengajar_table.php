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
            $table->string('nuptk', 20);
            $table->foreign('nuptk')->references('nuptk')->on('dosen')->onDelete('cascade');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->foreign('id_mata_kuliah')
            ->references('id_mata_kuliah')
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
