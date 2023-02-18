<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(static::class);
    }

    public function replies()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function associateParentComment()
    {
        if ($this->replies()->exists()) {
            return;
        }

        $this->parent()->associate($this->findRandomToMakeParent())->save();
    }

    private function findRandomToMakeParent()
    {
        return $this->video
            ->comments()
            ->doesntHave('parent')
            ->where('id', '<>', $this->id)
            ->inRandomOrder()
            ->first();
    }
}
