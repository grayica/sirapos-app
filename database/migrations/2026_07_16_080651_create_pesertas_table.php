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
            Schema::create('pesertas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('posyandu_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nama_penerima');
            $table->enum('hubungan_penerima', [
                'Ibu',
                'Ayah',
                'Wali',
                'Diri Sendiri'
            ]);

            $table->string('nama_peserta');

            $table->enum('jenis_peserta', [
                'Ibu Hamil',
                'Balita'
            ]);

            $table->string('nomor_whatsapp', 20);

            $table->enum('status', [
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
