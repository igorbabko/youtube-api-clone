<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Category extends Model
{
    use HasFactory;

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeWithRelationships($query, array|string $with)
    {
        $relationships = ['videos'];

        return $query->with(array_intersect(Arr::wrap($with), $relationships));
    }

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }
}
