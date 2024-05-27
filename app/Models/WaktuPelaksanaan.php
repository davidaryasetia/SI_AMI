<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPelaksanaan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ami';
    protected $primaryKey = 'jadwal_ami_id';
    protected $fillable = [
        'tahun', 
        'tanggal_pembukaan_ami', 
        'tanggal_penutupan_ami', 
        'created_at', 
        'updated_at'
    ];
}
