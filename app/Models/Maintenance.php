<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToCenter;

class Maintenance extends Model
{
    use BelongsToCenter;
    protected $fillable = [
        "center",
        "responsible",
        "description",
        "topic",
        "is_active"
    ];
    protected $table = "maintenances";

    public function centerRelation()
    {
        return $this->belongsTo(Center::class, 'center');
    }

    public function tracking() : HasOne {
        return $this->hasOne(MaintenanceTracking::class);
    }

    public function documents() {
        return $this->morphMany(Document::class, 'documentstable');
    }
}
