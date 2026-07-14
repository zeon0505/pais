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
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('gelar_depan')->after('nama')->nullable();
            $table->string('gelar_belakang')->after('gelar_depan')->nullable();
            $table->string('program_studi')->after('jabatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn(['gelar_depan', 'gelar_belakang', 'program_studi']);
        });
    }
};