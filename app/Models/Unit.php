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

    // relasi ke auditor 
    public function auditors()
    {
        return $this->hasOne(Auditor::class, 'unit_id');
    }

    // Relasi ke users
    public function users()
    {
        return $this->hasMany(User::class, 'unit_id');
    }

    // // iterasi 1
    public function UnitsCabang(){
        return $this->hasMany(UnitCabang::class, 'unit_id');
    }
    



}
