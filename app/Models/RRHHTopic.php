<?php

namespace App\Models;

use App\Models\Traits\BelongsToCenter;
use Illuminate\Database\Eloquent\Model;

class RRHHTopic extends Model
{
    use BelongsToCenter;

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

    public function documents() {
        return $this->morphMany(Document::class, 'documentstable');
    }
}
