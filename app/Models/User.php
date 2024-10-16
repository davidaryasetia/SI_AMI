<?php

namespace App\Models;
// testing again

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    // Audite
    public function units_audite(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    // Unit Cabang
    public function units_cabang(): HasOne
    {
        return $this->hasOne(UnitCabang::class, 'unit_cabang_id', 'unit_cabang_id');
    }

    // Auditor 
    public function auditor1(): HasMany
    {
        return $this->hasMany(Auditor::class, 'auditor_1', 'user_id');
    }

    public function auditor2(): HasMany
    {
        return $this->hasMany(Auditor::class, 'auditor_2', 'user_id');
    }


    public function audite(): HasOne
    {
        return $this->hasOne(Audite::class, 'user_id', 'user_id');
    }

    // Login Audite Auditor 
    // Mengecek apakah user adalah admin
    public function isAdmin()
    {
        return $this->status_admin == 1;
    }

    // Mengecek apakah user adalah audite
    public function isAudite()
    {
        return $this->audite()->exists();
    }

    // Mengecek apakah user adalah auditor
    public function isAuditor()
    {
        return $this->auditor1()->exists() || $this->auditor2()->exists();
    }

    // Cek apakah user memiliki peran tertentu
    // Periksa apakah user memiliki role tertentu
    public function hasRole($role)
    {
        if ($role === 'admin') {
            return $this->isAdmin();
        }

        if ($role === 'audite') {
            return $this->isAudite();
        }

        if ($role === 'auditor') {
            return $this->isAuditor();
        }

        return false;
    }
}

