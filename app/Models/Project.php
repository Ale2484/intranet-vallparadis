<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'center',
        'name',
        'start',
        'user',
        'description',
        'observations',
        'is_active',
        'type'
    ];

    protected $casts = [
        'start' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relación con el centro
    public function centerRelation()
    {
        return $this->belongsTo(Center::class, 'center');
    }

    // Relación con el usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // Relación con los documentos
    public function documents()
    {
        return $this->hasMany(ProjectDocument::class, 'project');
    }

    // Scope para proyectos activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope para proyectos inactivos
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    // Scope para filtrar por tipo
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accesor para el label del tipo
    public function getTypeLabelAttribute()
    {
        $types = [
            'project' => 'Projecte',
            'commission' => 'Comissió'
        ];

        return $types[$this->type] ?? $this->type;
    }

    // Accesor para el estado
    public function getStatusLabelAttribute()
    {
        return $this->is_active ? 'Actiu' : 'Inactiu';
    }

    // Accesor para la fecha formateada
    public function getFormattedStartAttribute()
    {
        return $this->start ? $this->start->format('d/m/Y') : 'No especificada';
    }

    // Método para contar documentos
    public function getDocumentsCountAttribute()
    {
        return $this->documents()->count();
    }

    // Método para obtener documentos recientes
    public function getRecentDocumentsAttribute()
    {
        return $this->documents()->orderBy('created_at', 'desc')->take(5)->get();
    }
}