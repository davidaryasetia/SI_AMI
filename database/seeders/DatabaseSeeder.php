<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Unit;
use \App\Models\User;
use \App\Models\IndikatorKinerjaUnit;
use \App\Models\Auditor;
use App\Models\IndikatorKinerjaSubKegiatan;
use App\Models\UnitBranch;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Calling seeder
        $this->call([
            // Data Master
            UnitSeeder::class,
            UnitCabangSeeder::class,
            UserSeeder::class,
            AuditorSeeder::class,
            AuditeSeeder::class,
            IndikatorKinerjaKegiatanSeeder::class, 
            IndikatorKinerjaSubKegiatanSeeder::class, 
            IndikatorKinerjaUnitKerjaSeeder::class, 

            // Data Transaksi

        // Laporan
            LingkupAuditSeeder::class,
            TujuanAuditSeeder::class,
            LaporanAuditorSeeder::class,
        ]);
    }
}
