<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Arr;

class Model extends BaseModel
{
    protected static $relationships = [];

    public function scopeWithRelationships($query, array|string $with)
    {
        return $query->with(array_intersect(Arr::wrap($with), static::$relationships));
    }
}
