<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\BelongsToCenter;

class Course extends Model
{
    use BelongsToCenter;
    protected $table = "courses";
    protected $fillable = [
        "center_id",
        "code",
        "hours",
        "type",
        "modality",
        "name",
        "description",
        "assistant",
        "start_date",
        "end_date",
        "is_active"
    ];
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
    public function assistantRelation()
    {
        return $this->belongsTo(User::class, "assistant");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "course_users")->withPivot("certificate");
    }
    
    public function schedule()
    {
        return $this->hasMany(CourseSchedule::class);
    }
}
