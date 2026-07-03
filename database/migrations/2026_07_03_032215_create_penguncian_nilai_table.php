<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penguncian_nilai', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_tahun_ajaran');

            $table->enum('status', [
                'dikunci',
                'tidak_dikunci'
            ])->default('tidak_dikunci');

            $table->timestamps();

            $table->foreign('id_prodi')
                ->references('id_prodi')
                ->on('prodi')
                ->cascadeOnDelete();

            $table->foreign('id_tahun_ajaran')
                ->references('id_tahun_ajaran')
                ->on('tahun_ajaran')
                ->cascadeOnDelete();

            // Satu data untuk setiap prodi pada setiap tahun ajaran
            $table->unique(['id_prodi', 'id_tahun_ajaran']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penguncian_nilai');
    }
};