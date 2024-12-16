<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// unit
class Unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $primaryKey = 'unit_id';
    protected $fillable = [
        'jadwal_ami_id',
        'nama_unit',
        'tipe_data',
        'created_at',
        'updated_at'
    ];

    public function periode_pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(PeriodePelaksanaan::class, 'jadwal_ami_id', 'jadwal_ami_id');
    }

    public function users_audite(): HasMany
    {
        return $this->hasMany(User::class, 'unit_id', 'unit_id');
    }

    // unit cabang 
    public function units_cabang(): HasMany
    {
        return $this->hasMany(UnitCabang::class, 'unit_id', 'unit_id');
    }

    public function indikator_ikuk(): HasMany
    {
        return $this->hasMany(IndikatorKinerjaUnitKerja::class, 'unit_id', 'unit_id');
    }

    public function auditor(): HasOne
    {
        return $this->hasOne(Auditor::class, 'unit_id', 'unit_id');
    }

    public function audite(): HasMany
    {
        return $this->hasMany(Audite::class, 'unit_id', 'unit_id');
    }
}
