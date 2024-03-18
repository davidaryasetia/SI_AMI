<?php

namespace Database\Seeders;

use App\Models\TransaksiData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Unit 1 => Ukarni
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '357', 
            'hasil_audit' => 'melampaui', 
            'data_dukung' => 'data1.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 1, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '55', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data2.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 2, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 3, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 4, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '9.2', 
            'hasil_audit' => 'memenuhi',  
            'data_dukung' => 'data5.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 5, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '92', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data6.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 6, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0.80', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 7, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 8, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 9, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Ukarni', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '0', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data3.pdf', 
            'saran' => 'belum dijalankan karena menunggu Tracer Alumni selesai', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 1, 
            'unit_id' => 1, 
            'auditor_id' => 1, 
            'indikator_kinerja_id' => 10, 
        ]);

        // Unit 2 => P3M
        TransaksiData::create([
            'riwayat_nama_unit' => 'P3M', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '1', 
            'hasil_audit' => 'melampaui',  
            'data_dukung' => 'data_2_1.pdf', 
            'saran' => 'Data buku referensi yang dimasukkan sebagai capaian luaran merupakan data capaian buku monograf', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 2, 
            'unit_id' => 2, 
            'auditor_id' => 2, 
            'indikator_kinerja_id' => 11, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'P3M', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '1', 
            'hasil_audit' => 'melampaui',  
            'data_dukung' => 'data_2_1.pdf', 
            'saran' => 'Data buku referensi yang dimasukkan sebagai capaian luaran merupakan data capaian buku monograf', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 2, 
            'unit_id' => 2, 
            'auditor_id' => 2, 
            'indikator_kinerja_id' => 12, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'P3M', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '51', 
            'hasil_audit' => 'melampaui',  
            'data_dukung' => 'data_2_2.pdf', 
            'saran' => 'Data buku referensi yang dimasukkan sebagai capaian luaran merupakan data capaian buku monograf', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 2, 
            'unit_id' => 2, 
            'auditor_id' => 2, 
            'indikator_kinerja_id' => 13, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'P3M', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '16', 
            'hasil_audit' => 'melampaui',  
            'data_dukung' => 'data_2_2.pdf', 
            'saran' => 'Data buku referensi yang dimasukkan sebagai capaian luaran merupakan data capaian buku monograf', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 2, 
            'unit_id' => 2, 
            'auditor_id' => 2, 
            'indikator_kinerja_id' => 14, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'P3M', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '16', 
            'hasil_audit' => 'melampaui',  
            'data_dukung' => 'data_2_2.pdf', 
            'saran' => 'Data buku referensi yang dimasukkan sebagai capaian luaran merupakan data capaian buku monograf', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 2, 
            'unit_id' => 2, 
            'auditor_id' => 2, 
            'indikator_kinerja_id' => 15, 
        ]);
        
        
        // Unit Penalaran => 3
        TransaksiData::create([
            'riwayat_nama_unit' => 'Penalaran', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '7', 
            'hasil_audit' => 'belum memenuhi',  
            'data_dukung' => 'data_3_1.pdf', 
            'saran' => 'Mahasiswa PENS memiliki banyak prestasi akademik', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 3, 
            'unit_id' => 3, 
            'auditor_id' => 3, 
            'indikator_kinerja_id' => 16, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Penalaran', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '35', 
            'hasil_audit' => 'memenuhi',  
            'data_dukung' => 'data_3_2.pdf', 
            'saran' => 'Mahasiswa PENS memiliki banyak prestasi akademik', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 3, 
            'unit_id' => 3, 
            'auditor_id' => 3, 
            'indikator_kinerja_id' => 17, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Penalaran', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '8', 
            'hasil_audit' => 'memenuhi',  
            'data_dukung' => 'data_3_2.pdf', 
            'saran' => 'Mahasiswa PENS memiliki banyak prestasi akademik', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 3, 
            'unit_id' => 3, 
            'auditor_id' => 3, 
            'indikator_kinerja_id' => 18, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Penalaran', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '62', 
            'hasil_audit' => 'memenuhi',  
            'data_dukung' => 'data_3_2.pdf', 
            'saran' => 'Mahasiswa PENS memiliki banyak prestasi akademik', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 3, 
            'unit_id' => 3, 
            'auditor_id' => 3, 
            'indikator_kinerja_id' => 19, 
        ]);
        TransaksiData::create([
            'riwayat_nama_unit' => 'Penalaran', 
            'status_pengisian_audite' => true, 
            'status_verifikasi_auditor' => false, 
            'realisasi' => '26', 
            'hasil_audit' => 'memenuhi',  
            'data_dukung' => 'data_3_2.pdf', 
            'saran' => 'Mahasiswa PENS memiliki banyak prestasi akademik', 
            'pelaksanaan_id' => 1, 
            'laporan_auditor_id' => 3, 
            'unit_id' => 3, 
            'auditor_id' => 3, 
            'indikator_kinerja_id' => 20, 
        ]);
        
    }
}
