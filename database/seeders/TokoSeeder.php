<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Toko;

class TokoSeeder extends Seeder
{
    public function run()
    {
        // Data toko yang akan diisi ke tabel 'tokos'
        $data = [
            [
                'id_toko' => 'TOKO001',
                'nama_toko' => 'joyo Subur',
                'pemilik' => 'Joko',
                'alamat' => 'Sumbersari',
                'nomor_tlp' => '1234567890',
            ],
            [
                'id_toko' => 'TOKO002',
                'nama_toko' => 'Toko Barokah',
                'pemilik' => 'Pendi',
                'alamat' => 'Jl. Kalimantan',
                'nomor_tlp' => '0987654321',
            ],
            // Tambahkan data toko lainnya sesuai kebutuhan
        ];

        // Masukkan data ke tabel 'tokos'
        Toko::insert($data);
    }
}

