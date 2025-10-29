<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function comments() : HasMany {
        return $this->hasMany(CommentsTracking::class);
    }
}
