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
            Schema::create('jadwals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('posyandu_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');

            $table->enum('status', [
                'Draft',
                'Scheduled',
                'Completed'
            ])->default('Draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
