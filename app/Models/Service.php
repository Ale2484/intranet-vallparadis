<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";
    protected $fillable = [
        "center_id",
        "type",
        "manager_name",
        "manager_email",
        "manager_phone"
    ];
    
}
