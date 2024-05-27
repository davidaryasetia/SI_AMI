<?php

namespace Database\Seeders;

use App\Models\WaktuPelaksanaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuPelaksanaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WaktuPelaksanaan::create([
            'tahun' => 2022,
            'tanggal_pembukaan_ami' => '2022-02-01 00:00:00',
            'tanggal_penutupan_ami' => '2024-03-01 23:59:59',
        ]);
        WaktuPelaksanaan::create([
            'tahun' => 2023,
            'tanggal_pembukaan_ami' => '2023-02-01 00:00:00',
            'tanggal_penutupan_ami' => '2023-03-01 23:59:59',
        ]);
        WaktuPelaksanaan::create([
            'tahun' => 2024,
            'tanggal_pembukaan_ami' => '2024-02-01 00:00:00',
            'tanggal_penutupan_ami' => '2024-03-01 23:59:59',
        ]);
    }
}
