<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryService extends Model
{
    protected $table = "complementary_services";
    protected $fillable = [
        "center_id",
        "type",
        "type",
        "manager_name",
        "manager_email",
        "manager_phone",
        "schedules",
        "is_active"
    ];
}
