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
            $table->string('slug')->after('nama')->unique()->nullable();
            $table->string('nidn')->after('jabatan')->unique()->nullable();
            $table->string('nuptk')->after('nidn')->unique()->nullable();
            $table->string('jabatan_akademik')->after('nuptk')->nullable();
            $table->string('status')->after('jabatan_akademik')->nullable();
            $table->string('email')->after('status')->unique()->nullable();
            $table->string('google_scholar')->after('email')->nullable();
            $table->string('pendidikan_terakhir')->after('google_scholar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'nidn',
                'nuptk',
                'jabatan_akademik',
                'status',
                'email',
                'google_scholar',
                'pendidikan_terakhir',
            ]);
        });
    }
};