<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralService extends Model
{
    protected $table = "general_services";
    protected $fillable = [
        "center_id",
        "name",
        "type",
        "manager_name",
        "manager_email",
        "manager_phone",
        "is_active"
    ];
    
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
