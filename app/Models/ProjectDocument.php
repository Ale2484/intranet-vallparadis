<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $table = 'projecte_documents';

    protected $fillable = [
        'name',
        'project',
        'path'
    ];

    // Relación con el proyecto
    public function projectRelation()
    {
        return $this->belongsTo(Project::class, 'project');
    }

    // Accesor para la URL del documento
    public function getDocumentUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    // Accesor para la extensión del archivo
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    // Accesor para el tipo de archivo (icono)
    public function getFileTypeAttribute()
    {
        $extension = strtolower($this->file_extension);
        
        $types = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
        ];

        return $types[$extension] ?? 'file';
    }

    // Método para obtener el tamaño del archivo
    public function getFileSize()
    {
        if (Storage::disk('public')->exists($this->path)) {
            return Storage::disk('public')->size($this->path);
        }
        return 0;
    }

    // Accesor para el tamaño formateado
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->getFileSize();
        if ($bytes === 0) return '0 Bytes';
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }
}