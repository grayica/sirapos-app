<?php

namespace Database\Seeders;

use App\Models\Posyandu;
use Illuminate\Database\Seeder;

class PosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_posyandu' => 'Posyandu Mawar', 'dusun' => 'Krajan', 'lokasi' => 'Balai Dusun Krajan'],
            ['nama_posyandu' => 'Posyandu Melati', 'dusun' => 'Krajan', 'lokasi' => 'Balai Dusun Krajan'],
            ['nama_posyandu' => 'Posyandu Anggrek', 'dusun' => 'Sumber', 'lokasi' => 'Balai Dusun Sumber'],
            ['nama_posyandu' => 'Posyandu Kenanga', 'dusun' => 'Sumber', 'lokasi' => 'Balai Dusun Sumber'],
            ['nama_posyandu' => 'Posyandu Dahlia', 'dusun' => 'Tengah', 'lokasi' => 'Balai Dusun Tengah'],
            ['nama_posyandu' => 'Posyandu Flamboyan', 'dusun' => 'Tengah', 'lokasi' => 'Balai Dusun Tengah'],
            ['nama_posyandu' => 'Posyandu Bougenville', 'dusun' => 'Timur', 'lokasi' => 'Balai Dusun Timur'],
            ['nama_posyandu' => 'Posyandu Cempaka', 'dusun' => 'Timur', 'lokasi' => 'Balai Dusun Timur'],
            ['nama_posyandu' => 'Posyandu Teratai', 'dusun' => 'Barat', 'lokasi' => 'Balai Dusun Barat'],
            ['nama_posyandu' => 'Posyandu Sakura', 'dusun' => 'Barat', 'lokasi' => 'Balai Dusun Barat'],
        ];

        foreach ($data as $item) {
            Posyandu::create($item);
        }
    }
}
