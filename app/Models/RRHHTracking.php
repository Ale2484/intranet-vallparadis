<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRHHTracking extends Model
{
    protected $fillable = [
        "issue",
        "user",
        "description",
    ];
    protected $table = "tracking_issues_rrhh";

    public function rrhhRelation()
    {
        return $this->belongsTo(RRHHTopic::class, 'issue');
    }
}
