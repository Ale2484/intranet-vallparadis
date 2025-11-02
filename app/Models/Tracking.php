<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tracking extends Model
{
    protected $fillable = [
        "register",
        "topic",
        "user",
        "open",
        "origin",
        "end_link"
    ];
    protected $table = "trackings";

    // relacion con comentarios
    public function comments(): HasMany
    {
        return $this->hasMany(CommentsTracking::class, 'tracking', 'id');
    }
        
    public function lastComment(): HasOne
    {
        return $this->hasOne(CommentsTracking::class, 'tracking', 'id')->latest('created_at');
    }

    // Relación con usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function registerRelation()
    {
        return $this->belongsTo(User::class, 'register');
    }
}
