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

    public function unit_cabang(): HasMany
    {
        return $this->hasMany(UnitCabang::class, 'unit_id', 'unit_id');
    }
    



}
