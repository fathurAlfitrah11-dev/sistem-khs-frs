<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahun_ajaran', function (Blueprint $table) {

            $table->boolean('nilai_dikunci')
                  ->default(false)
                  ->after('deadline_input_nilai');

        });
    }

    public function down(): void
    {
        Schema::table('tahun_ajaran', function (Blueprint $table) {

            $table->dropColumn('nilai_dikunci');

        });
    }
};