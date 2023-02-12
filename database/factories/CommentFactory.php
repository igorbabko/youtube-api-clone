<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            if ($comment->replies()->exists()) {
                return;
            }

            $comment->parent()->associate($this->findRandomCommentToMakeParentOf($comment))->save();
        });
    }

    public function definition()
    {
        return [
            'text' => fake()->sentences(mt_rand(1, 3), true),
            'parent_id' => null,
            'user_id' => User::inRandomOrder()->first(),
            'video_id' => Video::inRandomOrder()->first(),
        ];
    }

    private function findRandomCommentToMakeParentOf(Comment $comment)
    {
        return $comment->video
            ->comments()
            ->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()
            ->first();
    }
}
