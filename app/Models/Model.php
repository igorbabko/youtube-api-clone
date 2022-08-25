<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Arr;

class Model extends BaseModel
{
    protected static $relationships = [];

    public function scopeWithRelationships($query, $relationships)
    {
        return $query->with($this->validRelationship($relationships));
    }

    public function loadRelationships($relationships): self
    {
        return $this->load($this->validRelationships($relationships));
    }

    private function validRelationships($relationships): array
    {
        return array_intersect(Arr::wrap($relationships), static::$relationships);
    }
}
