<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccidentabiliteComment extends Model
{
    protected $fillable = [
        "user",
        "accidentabilitie",
        "description"
    ];
    protected $table = "comments_accidentabilities";

    // Relación con usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // relacion maintenance
        public function trackingRelation()
    {
        return $this->belongsTo(Accidentabilite::class, 'accidentabilitie');
    }
}
