<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Unit;
use \App\Models\User;
use \App\Models\IndikatorKinerjaUnit;
use \App\Models\Auditor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


         // User
         User::create([
            'unit_id' => 1,
            'nama' => 'Hary Oktavianto',
            'nip' => 1970121001,
            'status_admin' => true,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([
            'unit_id' => 2,
            'nama' => 'Nana Ramadijanti',
            'nip' => 1974521001,
            'status_admin' => true,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([
            'unit_id' => 3,
            'nama' => 'Tita Karlita',
            'nip' => 1985521001,
            'status_admin' => true,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 4,
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521001,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);


        // Unit
        Unit::create([
            'unit' => 'Ukarni',
        ]);
        Unit::create([
            'unit' => 'P3M',
        ]);
        Unit::create([
            'unit' => 'Penalaran',
        ]);
        Unit::create([
            'unit' => 'Minat Bakat',
        ]);
        Unit::create([
            'unit' => 'P4MP Pembelajaran',
        ]);
        Unit::create([
            'unit' => 'P4MP SPM',
        ]);
        Unit::create([
            'unit' => 'UPUK',
        ]);
        Unit::create([
            'unit' => 'BAK',
        ]);
        Unit::create([
            'unit' => 'SPI',
        ]);
        Unit::create([
            'unit' => 'UPUK',
        ]);

        // Auditor 
        Auditor::create([
            'unit_id' => 1, 
            'user_id' => 2,
        ]);
        Auditor::create([
            'unit_id' => 1, 
            'user_id' => 3,
        ]);


        // Indikator Kinerja Unit
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.1',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.2',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.3',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.4',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.5',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang melanjutkan studi ke jenjang berikutnya',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.6',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.7',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.8',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.9',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.10',
            'indikator_kinerja_unit_kerja' => 'Jumlah responden tracer study pada tahun anggaran berjalan (Lulusan T-1)',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);

        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.1',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan' => 'nominal',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.2',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan' => 'nominal',
            'target' => 24,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.3',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan' => 'nominal',
            'target' => 24,
        ]);
       
    }
}
