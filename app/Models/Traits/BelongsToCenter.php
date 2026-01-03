<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToCenter
{
    protected static function bootBelongsToCenter()
    {
        static::addGlobalScope("center_scope", function (Builder $builder) {
            if (Auth::hasUser() && Session::has("active_center_id")) {
                $builder->where(function ($query) use ($builder) {
                    $query->where("center", Session::get("active_center_id"));
                    // Si lo que se consulta es la tabla de usuarios
                    if ($builder->getModel() instanceof \App\Models\User) {
                        $query->orWhere("id", Auth::id());
                    }
                });
            }
        });

        static::creating(function ($model) {
            if (Session::has("active_center_id")) {
                $model->center = Session::get("active_center_id");
            }
        });

    }
}
