<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;

class PesertaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return Peserta::updateOrCreate(

            [
                'nomor_whatsapp' => $row[4]
            ],

            [
                'nama_penerima' => $row[0],
                'nama_balita' => $row[1],
                'jenis_kelamin' => $row[2],
                'tanggal_lahir' => $row[3],
                'alamat' => $row[5],
            ]

        );
    }
}
