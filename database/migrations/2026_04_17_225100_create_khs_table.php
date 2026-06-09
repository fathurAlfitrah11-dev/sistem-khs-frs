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
            $table->id('id_khs');

            $table->unsignedBigInteger('krs_detail_id');
            $table->foreign('krs_detail_id')
                ->references('id_krs_detail')
                ->on('krs_detail')
                ->onDelete('cascade');
            $table->string('nik');
            $table->foreign('nik')
                ->references('nik')
                ->on('dosen')
                ->onDelete('cascade');

            $table->float('partisipatif')->nullable();
            $table->float('tugas')->nullable();
            $table->float('quiz')->nullable();
            $table->float('proyek')->nullable();
            $table->float('uts')->nullable();
            $table->float('uas')->nullable();

            $table->float('na')->nullable();
            $table->string('nh', 2)->nullable();
            
            // Kolom status untuk membedakan Draft dan Final
            $table->enum('status', ['Draft', 'Final'])->default('Draft');

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