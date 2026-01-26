<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentabilite extends Model
{
    protected $fillable = [
        "user",
        "start",
        "end",
        "context",
        "description",
        "evaluate",
        "type",

    ];
    protected $table = "accidentabilites";

    public function evaluateRelation()
    {
        return $this->belongsTo(User::class, 'evaluate');
    }

    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }
}