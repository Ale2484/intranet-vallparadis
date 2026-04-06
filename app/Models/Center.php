<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Modelo que representa un centro que pertenece a la intranet de vallparadis
 *
 * Gestiona informacion de un centro y sus relaciones con usuario, cursos, 
 * proyectos, y documentos
 */
class Center extends Model
{
    protected $fillable = [
        "name",
        "address",
        "phone",
        "email",
        "is_active"
    ];
    protected $table = "centers";

    /**
     * Obtiene los usuarios asociados al centro
     * @return HasMany
     */
    public function user() : HasMany {
        return $this->hasMany(User::class);
    }

    /**
     * Obtiene los cursos asociados al centro
     * @return HasMany
     */
    public function course() : HasMany {
        return $this->hasMany(Course::class);
    }

    /**
     * Obtiene los proyectos y comisiones asociadas al centro
     * @return HasMany
     */
    public function project() : HasMany {
        return $this->hasMany(Project::class);
    }

    /**
     * Obtiene todos los documentos asociados al centro a traves de una relacion polimorfica
     * @return MorphMany
     */
    public function documents() {
        return $this->morphMany(Document::class, 'documentstable');
    }
}
