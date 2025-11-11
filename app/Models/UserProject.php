<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $fillable = [
        'user',
        'project'
    ];
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user');
    }
    public function projectRelation()
    {
        return $this->belongsTo(Project::class, 'id');
    }
}
