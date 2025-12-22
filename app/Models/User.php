<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "phone",
        "role",
        "center",
        "status",
        "locker",
        "locker_password",
        "password",
        "is_active",
        "profile_photo_path",
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
            "created_at" => "datetime",
            "updated_at" => "datetime",
        ];
    }

    // Relación con center
    public function centerRelation()
    {
        return $this->belongsTo(Center::class, "center");
    }

    public function uniformity() : HasOne
    {
        return $this->hasOne(Uniformity::class, "user", "id");
    }

    // Accesor para el label del rol
    public function getRoleLabelAttribute()
    {
        $roles = [
            "technical_team" => "Equip Tècnic",
            "management_team" => "Equip Directiu",
            "administration" => "Administració",
            "professional" => "Professional"
        ];

        return $roles[$this->role] ?? $this->role;
    }

    // Relacion Seguimiento
    public function tracking() : HasMany {
        return $this->hasMany(Tracking::class);
    }
    
    public function courses()
    {
        return $this->belongsToMany(Course::class, "course_users");
    }
}