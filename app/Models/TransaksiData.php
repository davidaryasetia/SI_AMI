<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiData extends Model
{
    use HasFactory;
    protected $table = 'transaksi_data_ikuk';
    protected $primaryKey='transaksi_data_ikuk_id';
    protected $fillable = [
       'indikator_kinerja_unit_kerja_id', 
       'jadwal_ami_id', 
       'laporan_auditor_id', 
       'riwayat_nama_unit', 
       'hasil_audit', 
       'status_pengisian_audite', 
       'status_verifikasi_auditor', 
       'realisasi_ikuk', 
       'analisis', 
       'target_lama', 
       'target_tahun_depan', 
       'strategi_pencapaian', 
       'sarpras_yang_dibutuhkan', 
       'faktor_pendukung', 
       'faktor_penghambat', 
       'akar_masalah', 
       'tindak_lanjut', 
       'status', 
       'data_dukung', 
    ];

    // Terhadap indikator kinerja unit kerja
    public function indikator_ikuk(): BelongsTo
    {
        return $this->belongsTo(IndikatorKinerjaUnitKerja::class, 'indikator_kinerja_unit_kerja_id', 'indikator_kinerja_unit_kerja_id');
    }

    // Terhadap periode pelaksanaa
    public function periode_pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(PeriodePelaksanaan::class, "jadwal_ami_id", "jadwal_ami_id");
    }
}
