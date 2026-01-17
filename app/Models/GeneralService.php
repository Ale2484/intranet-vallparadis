<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToCenter;
class GeneralService extends Model
{
    use BelongsToCenter;
    protected $table = "general_services";
    protected $fillable = [
        "center_id",
        "name",
        "type",
        "manager_name",
        "manager_email",
        "manager_phone",
        "staff_and_schedules",
        "is_active"
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function observations()
    {
        return $this->morphMany(Observation::class, "obsable");
    }
}
