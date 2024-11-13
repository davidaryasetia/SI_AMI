<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function transaksiData(): HasMany
    {
        return $this->hasMany(TransaksiData::class, 'jadwal_ami_id', 'jadwal_ami_id');
    }
}
