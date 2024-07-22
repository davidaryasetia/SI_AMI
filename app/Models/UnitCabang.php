<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UnitCabang extends Model
{
    use HasFactory;
    protected $table='unit_cabang';
    protected $primaryKey='unit_cabang_id';
    protected $fillable=[
        'unit_id',
        'nama_unit', 
        'created_at', 
        'updated_at'
    ];
    
    public function users_cabang(): BelongsTo
    {
        return $this->belongsTo(User::class, 'unit_cabang_id', 'unit_cabang_id');
    }

    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    
}

