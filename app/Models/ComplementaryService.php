<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryService extends Model
{
    protected $table = "complementary_services";
    protected $fillable = [
        "center_id",
        "name",
        "type",
        "manager_name",
        "manager_email",
        "manager_phone",
        "schedules",
        "is_active"
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
