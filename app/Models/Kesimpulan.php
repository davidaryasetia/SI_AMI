<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesimpulan extends Model
{
    use HasFactory;
    protected $table = 'kesimpulan';
    protected $primaryKey = 'no_kesimpulan';
    protected $fillable = [
        'indikator_kinerja', 
        'jumlah_indikator', 
        'peluang_peningkatan', 
        'created_at', 
        'updated_at', 
        'laporan_auditor_id'
    ];
}
