<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "course_users");
    }
}
