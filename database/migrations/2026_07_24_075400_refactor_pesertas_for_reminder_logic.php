<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Ubah ENUM menjadi VARCHAR
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE pesertas
            MODIFY jenis_peserta VARCHAR(50) NOT NULL
        ");

        /*
        |--------------------------------------------------------------------------
        | Tambah field baru
        |--------------------------------------------------------------------------
        */

        Schema::table('pesertas', function (Blueprint $table) {

            // Digunakan untuk menghitung usia Balita
            $table->date('tanggal_lahir')
                ->nullable()
                ->after('jenis_peserta');

            // Digunakan untuk Ibu Hamil
            $table->string('status_kehamilan')
                ->nullable()
                ->after('tanggal_lahir');

        });
    }

    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_lahir',
                'status_kehamilan',
            ]);

        });

        DB::statement("
            ALTER TABLE pesertas
            MODIFY jenis_peserta ENUM(
                'Ibu Hamil',
                'Balita'
            ) NOT NULL
        ");
    }
};
