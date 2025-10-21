<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'center',
        'status',
        'locker',
        'locker_password',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Relación con center
    public function centerRelation()
    {
        return $this->belongsTo(Center::class, 'center');
    }

    public function uniformity() : HasOne
    {
        return $this->hasOne(Uniformity::class, 'user', 'id');
    }

    // Scope para usuarios activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope para usuarios inactivos
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    // Accesor para el label del rol
    public function getRoleLabelAttribute()
    {
        $roles = [
            'technical_team' => 'Equip Tècnic',
            'management_team' => 'Equip Directiu',
            'administration' => 'Administració',
            'professional' => 'Professional'
        ];

        return $roles[$this->role] ?? $this->role;
    }
}