<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRHHTopic extends Model
{
    protected $fillable = [
        "center",
        "opening",
        "user_affected",
        "description",
        "user_register",
        "derivative",
        "topic",
        "is_active"
    ];
    protected $table = "rrhh_topics";

    public function centerRelation()
    {
        return $this->belongsTo(Center::class, 'center');
    }

    public function userAffectedRelation()
    {
        return $this->belongsTo(User::class, 'user_affected');
    }
    
    public function userRegisterRelation()
    {
        return $this->belongsTo(User::class, 'user_register');
    }


    public function tracking() : HasOne {
        return $this->hasOne(RRHHTracking::class);
    }
}
