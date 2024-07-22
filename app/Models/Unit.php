<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function users_audite(): HasMany
    {
        return $this->hasMany(User::class, 'unit_id', 'unit_id');
    }

    // unit cabang 
    public function units_cabang(): HasMany
    {
        return $this->hasMany(UnitCabang::class, 'unit_id', 'unit_id');
    }

    public function indikator_ikuk():HasMany
    {
        return $this->hasMany(IndikatorKinerjaUnitKerja::class, 'unit_id', 'unit_id');
    }
}
