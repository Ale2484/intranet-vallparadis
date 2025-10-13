<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Uniformity extends Model
{
    protected $table = "uniformities";

    public function userAssigned(): BelongsTo {
        return $this->belongsTo(User::class, "user");
    }

    public function userDelivery(): BelongsTo {
        return $this->belongsTo(User::class, "user_delivery");
    }

}
