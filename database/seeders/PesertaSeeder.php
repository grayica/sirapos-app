<?php

namespace Database\Seeders;

use App\Models\Peserta;
use Illuminate\Database\Seeder;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'posyandu_id' => 1,
                'nama_penerima' => 'Siti Aminah',
                'hubungan_penerima' => 'Ibu',
                'nama_peserta' => 'Aisyah',
                'jenis_peserta' => 'Balita',
                'nomor_whatsapp' => '081234567890',
                'status' => 'Aktif',
            ],
            [
                'posyandu_id' => 2,
                'nama_penerima' => 'Rina Wati',
                'hubungan_penerima' => 'Diri Sendiri',
                'nama_peserta' => 'Rina Wati',
                'jenis_peserta' => 'Ibu Hamil',
                'nomor_whatsapp' => '081234567891',
                'status' => 'Aktif',
            ],
            [
                'posyandu_id' => 3,
                'nama_penerima' => 'Dewi Lestari',
                'hubungan_penerima' => 'Ibu',
                'nama_peserta' => 'Rafi',
                'jenis_peserta' => 'Balita',
                'nomor_whatsapp' => '081234567892',
                'status' => 'Aktif',
            ],
        ];

        foreach ($data as $item) {
            Peserta::create($item);
        }
    }
}
