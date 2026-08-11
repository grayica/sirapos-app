<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY status ENUM(
                'Pending',
                'Aktif',
                'Nonaktif'
            )
            DEFAULT 'Pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY status ENUM(
                'Aktif',
                'Nonaktif'
            )
            DEFAULT 'Aktif'
        ");
    }
};
