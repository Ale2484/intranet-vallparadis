<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $table = "course_users";
    protected $fillable = [
        "user_id",
        "course_id",
        "certificate"
    ];
}
