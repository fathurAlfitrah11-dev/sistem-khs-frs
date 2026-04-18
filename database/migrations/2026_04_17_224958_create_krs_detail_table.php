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
        Schema::create('krs_detail', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('id_krs');
    $table->foreign('id_krs')
        ->references('id_krs')
        ->on('krs')
        ->onDelete('cascade');

    $table->unsignedBigInteger('pengajar_id');
    $table->foreign('pengajar_id')
        ->references('id')
        ->on('pengajar')
        ->onDelete('cascade');
    $table->enum('status_wali', ['pending','disetujui','ditolak'])
          ->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs_detail');
    }
};
