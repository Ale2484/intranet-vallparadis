<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_id',
        'category',
        'reason',
        'company_or_department',
        'contact_person',
        'phone',
        'email',
        'is_active',
        'observations',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
