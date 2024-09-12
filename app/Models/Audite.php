<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audite extends Model
{
    use HasFactory;
    protected $table = 'audite';
    protected $primaryKey = 'audite_id';
    protected $fillable = [
        'unit_id',
        'unit_cabang_id',
        'user_id',
    ];

    public function users_audite(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    public function units_cabang(): BelongsTo
    {
        return $this->belongsTo(UnitCabang::class, 'unit_cabang_id', 'unit_cabang_id');
    }



}
