<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniformityRenovation extends Model
{
    protected $table = 'uniformity_renovations';

    protected $fillable = [
        "uniformity_id",
        "renewal_date",
        "delivered_by",
        "file"
    ];

    // Relacion con el uniforme 
    public function uniformity()
    {
        return $this->belongsTo(Uniformity::class, "uniformity_id");
    }

    // Relacion con el usuario que entrega la renovacion
    public function deliveredBy()
    {
        return $this->belongsTo(User::class, "delivered_by");
    }
    
    
}
