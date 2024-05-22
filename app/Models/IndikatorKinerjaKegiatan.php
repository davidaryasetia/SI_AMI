<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaKegiatan extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_kegiatan';
    protected $primaryKey = 'indikator_kinerja_kegiatan_id';
    protected $fillable = [
      'unit_id', 
      'kode_ikk', 
      'isi_indikator_kinerja_kegaitan', 
      'satuan_ikk', 
      'target_ikk'
    ];

    // indikator_kinerja_kegiatan -> indikator_kinerja_sub_kegiatan (one to many)
    public function Indikator_Kinerja_Sub_Kegiatan(){
      return $this->hasMany(IndikatorKinerjaSubKegiatan::class);
    }

    public function Indikator_Kinerja_Kegiatan(){
      return $this->belongsTo(Unit::class);
    }

    
}


