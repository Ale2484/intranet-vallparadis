<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Document extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'path',
        'user',
        'documentstable_id',
        'documentstable_type',
    ];

    public function documentstable()
    {
        return $this->morphTo();
    }

    public function userData()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // Método para obtener el tamaño del archivo
    public function getFileSize()
    {
        if (Storage::disk('private')->exists($this->path)) {
            $bytes = Storage::disk('private')->size($this->path);   
        } else {
            $bytes = 0;
        }
        return $bytes;
    }

    // Accesor para el tamaño formateado
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->getFileSize();
        if ($bytes === 0) {
            $result = '0 Bytes';
        } else {
            $k = 1024;
            $sizes = ['Bytes', 'KB', 'MB', 'GB'];
            $i = floor(log($bytes) / log($k));
            $result = round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
        }
        return $result;
        
    }
}