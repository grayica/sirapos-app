<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            $table->boolean('wa_verified')
                ->default(false)
                ->after('nomor_whatsapp');

        });
    }

    public function down(): void
    {
        Schema::table('pesertas', function (Blueprint $table) {

            $table->dropColumn('wa_verified');

        });
    }
};
