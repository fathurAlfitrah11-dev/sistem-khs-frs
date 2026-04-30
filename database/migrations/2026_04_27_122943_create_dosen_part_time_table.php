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
        Schema::create('dosen_part_time', function (Blueprint $table) {
            $table->id('id_dosen_part_time');
            $table->string('nuptk', 20)->unique();
            $table->string('nama_dosen', 100);
            $table->string('tempat_part_time', 150);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_part_time');
    }
};
