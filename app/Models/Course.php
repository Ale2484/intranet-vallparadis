<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
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

    public function users()
    {
        return $this->belongsToMany(User::class, "course_users");
    }
    
    public function schedule()
    {
        return $this->hasMany(CourseSchedule::class);
    }
}
