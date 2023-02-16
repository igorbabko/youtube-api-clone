<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::saving(function (Comment $comment) {
            $comment->user_id = $comment->user_id ?: auth()->id();

            if ($comment->parent_id) {
                $comment->video_id = Comment::find($comment->parent_id)->video_id;
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(static::class);
    }

    public function replies()
    {
        return $this->hasMany(static::class, 'parent_id')->with('replies');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function scopeSearch($query, ?string $text)
    {
        return $query->where('text', 'like', "%$text%");
    }
}
