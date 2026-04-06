<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\BelongsToCenter;

/**
 * Modelo que representa un curso dentro de la intranet
 * 
 * Gestiona la informacion de un curso y sus relaciones con el centro
 * al que pertenece, sus usuarios, el asistente del curso y su horario
 */
class Course extends Model
{
    use BelongsToCenter;
    protected $table = "courses";
    protected $fillable = [
        "center_id",
        "code",
        "hours",
        "type",
        "modality",
        "name",
        "description",
        "assistant",
        "start_date",
        "end_date",
        "is_active"
    ];

    /**
     * Obtiene el centro al que pertenece el curso
     * @return BelongsTo
     */
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    /**
     * Obtiene el usuario que actua como asistente del curso
     * @return BelongsTo
     */
    public function assistantRelation()
    {
        return $this->belongsTo(User::class, "assistant");
    }

    /**
     * Obtiene los usuarios que estan inscritos al curso
     * Incluye la informacion de los certificados de los usuarios (tabla certificate) como tabla pivote
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, "course_users")->withPivot("certificate");
    }
    
    /**
     * Obtiene el horario del curso
     * @return HasMany
     */
    public function schedule()
    {
        return $this->hasMany(CourseSchedule::class);
    }
}
