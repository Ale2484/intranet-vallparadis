<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "files";
    protected $fillable = [
        "user_id",
        "center_id",
        "type"
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, "center_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
