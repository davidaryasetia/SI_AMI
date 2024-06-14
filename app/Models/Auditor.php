<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $table='auditor';
    protected $primaryKey = 'auditor_id';
    protected $fillable = [
        'unit_id', 
        'auditor_1', 
        'auditor_2', 
        'created_at', 
        'updated_at', 
    ];

    // relasi ke user 
    public function users1()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function users2()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

}
