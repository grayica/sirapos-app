<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            // Kolom ini sudah ada
            // jenis_data
            // tanggal_lahir

            $table->date('tanggal_mulai_kehamilan')
                ->nullable()
                ->after('tanggal_lahir');
        });
    }

    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            $table->dropColumn('tanggal_mulai_kehamilan');
        });
    }
};
