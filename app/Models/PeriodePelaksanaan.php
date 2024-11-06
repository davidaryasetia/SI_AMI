<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePelaksanaan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ami';
    protected $primaryKey = 'jadwal_ami_id';
    protected $fillable = [
        'nama_periode_ami', 
        'tanggal_pembukaan_ami', 
        'tanggal_penutupan_ami', 
        'status', 
        'created_at', 
        'updated_at'
    ];
}
