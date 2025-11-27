<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralServiceObservation extends Model
{
    protected $table = "general_services_observations";
    
    protected $fillable = [
        "general_service_id",
        "observation",
    ];

    public function general_service()
    {
        return $this->belongsTo(GeneralService::class);
    }
}
