<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UniformityRenovation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Uniformity extends Model
{
    protected $table = "uniformities";
    protected $fillable = [
        'pants',
        'shirt',
        'shoes',
        'user',
    ];

    public function userAssigned(): BelongsTo {
        return $this->belongsTo(User::class, "user");
    }

    public function renovations(): HasMany {
        return $this->hasMany(UniformityRenovation::class);
    }


}
