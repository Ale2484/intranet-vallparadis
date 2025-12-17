<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
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
