<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'posyandu_id' => 1,
                'tanggal' => '2026-07-20',
                'jam' => '08:00:00',
                'lokasi' => 'Balai Dusun Krajan',
                'status' => 'Scheduled',
            ],
            [
                'posyandu_id' => 2,
                'tanggal' => '2026-07-21',
                'jam' => '08:00:00',
                'lokasi' => 'Balai Dusun Krajan',
                'status' => 'Scheduled',
            ],
            [
                'posyandu_id' => 3,
                'tanggal' => '2026-07-22',
                'jam' => '09:00:00',
                'lokasi' => 'Balai Dusun Sumber',
                'status' => 'Draft',
            ],
        ];

        foreach ($data as $item) {
            Jadwal::create($item);
        }
    }
}
