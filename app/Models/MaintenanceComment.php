<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceComment extends Model
{
    protected $fillable = [
        "user",
        "maintenance",
        "description"
    ];
    protected $table = "comments_maintenances";

    // Relación con usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    // relacion maintenance
        public function trackingRelation()
    {
        return $this->belongsTo(MaintenanceTracking::class, 'maintenance');
    }
}
