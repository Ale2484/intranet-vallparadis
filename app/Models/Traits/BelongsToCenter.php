<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToCenter
{
    protected function getCenterColumnName()
    {
        $centerColumnName = "center_id";
        if (in_array("center", $this->getFillable())) {
            $centerColumnName = "center";
        }
        return $centerColumnName;
    }
    protected static function bootBelongsToCenter()
    {
        static::addGlobalScope("center_filter", function (Builder $builder) {
            if (Auth::hasUser() && Session::has("active_center_id")) {
                $model = $builder->getModel();
                $table = $builder->getModel()->getTable();
                $column = $model->getCenterColumnName();
                $builder->where(function ($query) use ($builder, $table, $column) {
                    $query->where("$table.$column", Session::get("active_center_id"));
                    // Si lo que se consulta es la tabla de usuarios
                    if ($builder->getModel() instanceof \App\Models\User) {
                        $query->orWhere("$table.id", Auth::id());
                    }
                });
            }
        });

        static::creating(function ($model) {
            if (Session::has("active_center_id")) {
                $column = $model->getCenterColumnName();
                $model->{$column} = Session::get("active_center_id");
            }
        });

    }
}
