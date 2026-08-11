<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {

            $table->foreignId('posyandu_id')
                ->nullable()
                ->change();

            $table->date('tanggal')
                ->nullable()
                ->change();

            $table->time('jam')
                ->nullable()
                ->change();

            $table->string('lokasi')
                ->nullable()
                ->change();

            $table->enum('status', [
                'Draft',
                'Scheduled',
                'Completed',
                'Cancelled'
            ])->default('Draft')->change();
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {

            $table->foreignId('posyandu_id')->nullable(false)->change();
            $table->date('tanggal')->nullable(false)->change();
            $table->time('jam')->nullable(false)->change();
            $table->string('lokasi')->nullable(false)->change();

            $table->enum('status', [
                'Draft',
                'Scheduled',
                'Completed'
            ])->default('Draft')->change();
        });
    }
};
