<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    protected $fillable = [
        "evaluator",
        "comment",
        "user",
        "p1",
        "p2",
        "p3",
        "p4",
        "p5",
        "p6",
        "p7",
        "p8",
        "p9",
        "p10",
        "p11",
        "p12",
        "p13",
        "p14",
        "p15",
        "p16",
        "p17",
        "p18",
        "p19",
        "p20"
    ];
    protected $table = "evaluations";

    // Relación con usuario
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function evaluatorRelation()
    {
        return $this->belongsTo(User::class, 'evaluator');
    }
}
