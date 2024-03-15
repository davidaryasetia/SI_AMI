<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiData extends Model
{
    use HasFactory;
    protected $table = 'transaksi_data';
    protected $primaryKey='transaksi_data_id';
    protected $fillable = [
        'riwayat_nama_unit', 
        'status_pengisian_audite', 
        'status_verifikasi_auditor', 
        'realisasi', 
        'hasil_audit', 
        'data_dukung', 
        'saran', 
        'created_at', 
        'updated_at', 
        'pelaksanaan_id', 
        'laporan_auditor_id',
        'unit_id', 
        'auditor_id', 
        'indikator_kinerja_id' 
    ];
}
