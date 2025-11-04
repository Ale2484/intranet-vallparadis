<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentsTracking extends Model
{
    protected $fillable = [
        "user",
        "tracking",
        "comment"
    ];
    protected $table = "comments_trackings";

    // Relación con usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // relacion tracking
        public function trackingRelation()
    {
        return $this->belongsTo(Tracking::class, 'tracking');
    }
}
