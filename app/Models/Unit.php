<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// unit
class Unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $primaryKey = 'unit_id';
    protected $fillable = [
        'nama_unit',
        'created_at',
        'updated_at'
    ];

    // unit->indikator_kinerja_kegiatan (one to many)
    public function Indikator_Kinerja_Kegiatan(){
        return $this->hasMany(IndikatorKinerjaKegiatan::class);
    }



}
