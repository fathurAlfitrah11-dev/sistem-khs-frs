<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {

            $table->integer('persen_partisipatif')->default(0);
            $table->integer('persen_tugas')->default(0);
            $table->integer('persen_quiz')->default(0);
            $table->integer('persen_proyek')->default(0);
            $table->integer('persen_uts')->default(0);
            $table->integer('persen_uas')->default(0);

            $table->boolean('dikunci')->default(false);

        });
    }

    public function down(): void
    {
        Schema::table('mata_kuliah', function (Blueprint $table) {

            $table->dropColumn([
                'persen_partisipatif',
                'persen_tugas',
                'persen_quiz',
                'persen_proyek',
                'persen_uts',
                'persen_uas',
                'dikunci'
            ]);

        });
    }
};