<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\Beta;

class Auditor extends Model
{
    use HasFactory;
    protected $table='auditor';
    protected $primaryKey = 'auditor_id';
    protected $fillable = [
        'jadwal_ami_id', 
        'unit_id', 
        'auditor_1', 
        'auditor_2', 
        'created_at', 
        'updated_at', 
    ];

    public function periode_pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(PeriodePelaksanaan::class, 'jadwal_ami_id', 'jadwal_ami_id');
    }

    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    // // Relasi Ke unit cabang
    // public function units_cabang(): BelongsTo
    // {
    //     return $this->belongsTo(UnitCabang::class, 'unit_cabang_id', 'unit_cabang_id');
    // }

    // relasi ke user 
    public function auditor1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auditor_1', 'user_id');
    }
    
    public function auditor2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auditor_2', 'user_id');
    }
}
