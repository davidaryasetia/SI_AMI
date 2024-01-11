<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Unit;
use \App\Models\User;
use \App\Models\Indikator;

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

        // Unit
        Unit::create([
            'nama_unit' => 'Ukarni',
        ]);
        Unit::create([
            'nama_unit' => 'P3M',
        ]);
        Unit::create([
            'nama_unit' => 'Penalaran',
        ]);
        Unit::create([
            'nama_unit' => 'Minat Bakat',
        ]);
        Unit::create([
            'nama_unit' => 'Perencanaan',
        ]);
        Unit::create([
            'nama_unit' => 'P4MP Pembelajaran',
        ]);


        // User
        User::create([
            'unit_id' => 2,
            'nip' => 1970121001,
            'nama_lengkap' => 'Hary Oktavianto',
            'email' => 'hary@pens.ac.id',
            'no_telepon' => 62822323488,
            'password' => bcrypt('hary'),
            'status_admin' => true,
            'status_auditor' => true,
            'unit_id_diaudit' => 1,
            'status_audite' => false
        ]);
        User::create([
            'unit_id' => 2,
            'nip' => 1970001,
            'nama_lengkap' => 'Nana Ramadijanti',
            'email' => 'nana@pens.ac.id',
            'no_telepon' => 629328423882,
            'password' => bcrypt('nana'),
            'status_admin' => true,
            'status_auditor' => true,
            'unit_id_diaudit' => 3,
            'status_audite' => false
        ]);
        User::create([
            'unit_id' => 2,
            'nip' => 1979101,
            'nama_lengkap' => 'Tita Karlita',
            'email' => 'tita@pens.ac.id',
            'no_telepon' => 62283747238883,
            'password' => bcrypt('tita'),
            'status_admin' => true,
            'status_auditor' => true,
            'unit_id_diaudit' => 1,
            'status_audite' => true
        ]);

        // Indikator Kinerja Unit
        Indikator::create([
            'unit_id' => 1,
            'kode' => 'U23.1',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan' => 'nominal',
            'target' => 1,
        ]);
        Indikator::create([
            'unit_id' => 1,
            'kode' => 'U23.2',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)
            ',
            'satuan' => 'nominal',
            'target' => 1,
        ]);
        Indikator::create([
            'unit_id' => 1,
            'kode' => 'C9.35',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis da`lam bentuk  buku nasional/internasional yang mempunyai ISBN
            ',
            'satuan' => 'nominal',
            'target' => 3,
        ]);

        Indikator::create([
            'unit_id' => 1,
            'kode' => 'U23.3',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  book chapter internasional ',
            'satuan' => 'nominal',
            'target' => 2,
        ]);
        Indikator::create([
            'unit_id' => 1,
            'kode' => 'U23.4',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional/nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ
            ',
            'satuan' => 'nominal',
            'target' => 96,
        ]);
    }
}
