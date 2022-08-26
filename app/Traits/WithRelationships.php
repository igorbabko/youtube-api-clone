<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait WithRelationships
{
    public function scopeWithRelationships($query, array|string $with)
    {
        return $query->with(array_intersect(Arr::wrap($with), static::$relationships ?? []));
    }
}
