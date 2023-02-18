<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected static $relationships = ['channel', 'playlists', 'categories'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFromPeriod($query, ?Period $period)
    {
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where(function ($query) use ($text) {
            $query->where('title', 'like', "%$text%")
                ->orWhere('description', 'like', "%$text%");
        });
    }

    public function createRandomComments()
    {
        return Comment::factory(10)->create(['video_id' => $this->id]);
    }
}
