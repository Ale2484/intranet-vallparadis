<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['content'];

    public function documentstable()
    {
        return $this->morphTo();
    }
}