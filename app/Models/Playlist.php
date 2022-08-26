<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    protected static $relationships = ['channel', 'videos'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeSearch($query, ?string $name)
    {
        return $query->where('name', 'like', "%$name%");
    }
}
