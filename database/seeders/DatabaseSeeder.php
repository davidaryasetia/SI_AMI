<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Unit;
use \App\Models\User;
use \App\Models\IndikatorKinerjaUnit;
use \App\Models\Auditor;
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
            UnitSeeder::class,
            UnitBranchSeeder::class, 
            UserSeeder::class, 
            AuditorSeeder::class, 
            IndikatorKinerjaUnitSeeder::class, 
            WaktuPelaksanaanSeeder::class, 
            LingkupAuditSeeder::class, 
            TujuanAuditSeeder::class,
            LaporanAuditorSeeder::class, 
            TransaksiDataSeeder::class
        ]);
    }
}
