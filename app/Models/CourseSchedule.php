<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    protected $table = "course_schedules";

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
