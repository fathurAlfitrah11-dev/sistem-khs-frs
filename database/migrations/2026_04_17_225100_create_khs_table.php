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
        Schema::create('khs', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('krs_detail_id');
    $table->unsignedBigInteger('dosen_id');

    $table->float('partisipatif')->nullable();
    $table->float('tugas')->nullable();
    $table->float('quiz')->nullable();
    $table->float('proyek')->nullable();
    $table->float('uts')->nullable();
    $table->float('uas')->nullable();

    $table->float('na')->nullable();
    $table->string('nh')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
