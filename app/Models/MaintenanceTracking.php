<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTracking extends Model
{
    protected $fillable = [
        "maintenance",
        "user",
        "topic",
    ];
    protected $table = "monitorings_maintenances";

    public function maintenanceRelation()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance');
    }

    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
