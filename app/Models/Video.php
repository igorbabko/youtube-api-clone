<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
}
