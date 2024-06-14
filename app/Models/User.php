<?php

namespace App\Models;
// testing again

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'unit_id', 
        'unit_cabang_id', 
        'nama', 
        'nip', 
        'status_admin', 
        'email', 
        'password', 
        'email_verified_at', 
        'remember_token', 
        'created_at', 
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

/**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // auditor
    public function auditors1()
    {
        return $this->hasMany(Auditor::class, 'auditor_1');
    }
    
    public function auditors2()
    {
        return $this->hasMany(Auditor::class, 'auditor_2');
    }
}

