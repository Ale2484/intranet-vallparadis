<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    protected $fillable = [
        "name",
        "address",
        "phone",
        "email",
        "is_active"
    ];
    protected $table = "centers";

    public function user() : HasMany {
        return $this->hasMany(User::class);
    }
    
    public function course() : HasMany {
        return $this->hasMany(Course::class);
    }
    
    public function project() : HasMany {
        return $this->hasMany(Project::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }

}
