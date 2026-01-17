<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToCenter;
class ComplementaryService extends Model
{
    use BelongsToCenter;
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

    public function documents()
    {
        return $this->morphMany(Document::class, "documentstable");
    }
}
