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
    Schema::table('khs', function (Blueprint $table) {
        // Default diset sebagai 'Draft'
        $table->enum('status', ['Draft', 'Final'])->default('Draft')->after('nh');
    });
}


    /**
     * Reverse the migrations.
     */
   
public function down(): void
{
    Schema::table('khs', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
