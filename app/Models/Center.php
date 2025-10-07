<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    protected $fillable = [
        "name",
        "address",
        "phone"  
    ];
    protected $table = "centers";

    public function user() : HasMany {
        return $this->hasMany(User::class);
    }
}
