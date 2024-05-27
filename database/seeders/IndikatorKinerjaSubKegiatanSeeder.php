<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerjaSubKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorKinerjaSubKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ukarni -> IKK_1
        IndikatorKinerjaSubKegiatan::create([ // 1
            'indikator_kinerja_kegiatan_id' => 1, // ikk_ukarni_1
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan', 
            'kode_iksk' => 'IKU 1.1.1', 
            'satuan_iksk' => '%', 
            'target_iksk' => null

        ]);
        IndikatorKinerjaSubKegiatan::create([ // 2
            'indikator_kinerja_kegiatan_id' => 1, // ikk_ukarni_1
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase  lulusan S1 dan D4/D3/D2 yang berhasil melanjutkan studi', 
            'kode_iksk' => 'IKU 1.1.2', 
            'satuan_iksk' => '%', 
            'target_iksk' => null            
        ]);
        IndikatorKinerjaSubKegiatan::create([ // 3
            'indikator_kinerja_kegiatan_id' => 1, // ikk_ukarni_1
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase lulusan S1 dan D4/D3/D2 yang berhasil menjadi wirausaha', 
            'kode_iksk' => 'IKU 1.1.3', 
            'satuan_iksk' => '%', 
            'target_iksk' => null           
        ]);
        IndikatorKinerjaSubKegiatan::create([ // 4
            'indikator_kinerja_kegiatan_id' => 1, // ikk_ukarni_1
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase responden tracer study pada tahun anggaran berjalan (min 50% dari Lulusan T-1)', 
            'kode_iksk' => 'IKU 1.1.4', 
            'satuan_iksk' => '%', 
            'target_iksk' => null          
        ]);
        
        // Ukarni => IKK_2
        IndikatorKinerjaSubKegiatan::create([ // 5
            'indikator_kinerja_kegiatan_id' => 2, // ikk_ukarni_2
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator SPMI Unit Ukarni', 
            'kode_iksk' => 'IKU 1.1.5', 
            'satuan_iksk' => '%', 
            'target_iksk' => null           
        ]);
        IndikatorKinerjaSubKegiatan::create([ // 5
            'indikator_kinerja_kegiatan_id' => 2, // ikk_ukarni_2
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator manajemen di Ukarni', 
            'kode_iksk' => 'IKU 1.1.6', 
            'satuan_iksk' => '%', 
            'target_iksk' => null           
        ]);

        // P3M -> IKK_3
        IndikatorKinerjaSubKegiatan::create([ // 6
            'indikator_kinerja_kegiatan_id' => 3, // ikk_p3m_3
            'isi_indikator_kinerja_sub_kegiatan' => 'Jumlah keluaran penelitian  yang berhasil mendapat rekognisi internasional', 
            'kode_iksk' => 'IKU 2.3.1.1', 
            'satuan_iksk' => 'nominal', 
            'target_iksk' => null        
        ]); 
        IndikatorKinerjaSubKegiatan::create([ // 7
            'indikator_kinerja_kegiatan_id' => 3, // ikk_p3m_3
            'isi_indikator_kinerja_sub_kegiatan' => 'Jumlah keluaran penelitian atau pengabdian kepada masyarakat diterapkan oleh masyarakat per jumlah dosen', 
            'kode_iksk' => 'IKU 2.3.1.2', 
            'satuan_iksk' => 'nominal', 
            'target_iksk' => null        
        ]); 

        // P3M -> IKK_4
        IndikatorKinerjaSubKegiatan::create([ // 8
            'indikator_kinerja_kegiatan_id' => 4, // ikk_p3m_4
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator SPMI di P3M', 
            'kode_iksk' => 'IKU 5.1.1', 
            'satuan_iksk' => '%', 
            'target_iksk' => null        
        ]); 
        IndikatorKinerjaSubKegiatan::create([ // 9
            'indikator_kinerja_kegiatan_id' => 4, // ikk_p3m_4
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator Manajemen di P3M', 
            'kode_iksk' => 'IKU 5.1.2', 
            'satuan_iksk' => '%', 
            'target_iksk' => null           
        ]); 

        // Penalaran -> IKK_5
        IndikatorKinerjaSubKegiatan::create([ // 10
            'indikator_kinerja_kegiatan_id' => 5, // ikk_penalaran_5
            'isi_indikator_kinerja_sub_kegiatan' => 'Presentase mahasiswa S1 dan D4/D3/D2 yang meraih prestasi paling rendah tingkat nasional', 
            'kode_iksk' => 'IKU 1.2.1', 
            'satuan_iksk' => '%', 
            'target_iksk' => null        
        ]); 
       
        // Penalaran -> IKK_6
        IndikatorKinerjaSubKegiatan::create([ // 11
            'indikator_kinerja_kegiatan_id' => 6, // ikk_penalaran_6
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase dosen yang membimbing  mahasiswa berkegiatan di luar program studi dalam 5 tahun terakhir', 
            'kode_iksk' => 'IKU 2.1.1', 
            'satuan_iksk' => '%', 
            'target_iksk' => null        
        ]); 
       
        // Penalaran -> IKK_7
        IndikatorKinerjaSubKegiatan::create([ // 12
            'indikator_kinerja_kegiatan_id' => 7, // ikk_penalaran_7
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator SPMI di Penalaran', 
            'kode_iksk' => 'IKU 5.2.1', 
            'satuan_iksk' => '%', 
            'target_iksk' => null        
        ]); 
        IndikatorKinerjaSubKegiatan::create([ // 13
            'indikator_kinerja_kegiatan_id' => 7, // ikk_penalaran_7
            'isi_indikator_kinerja_sub_kegiatan' => 'Persentase ketercapaian indikator Manajemen di Penalaran', 
            'kode_iksk' => 'IKU 5.2.2', 
            'satuan_iksk' => '%', 
            'target_iksk' => null           
        ]); 
       


    }
}
