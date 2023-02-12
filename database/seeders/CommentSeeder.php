<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Video::limit(1)->get()
            ->map(fn ($video) => static::seedCommentsFor($video))
            ->flatten()
            ->each(fn ($comment) => static::associateParentCommentWith($comment));
    }

    private static function seedCommentsFor(Video $video)
    {
        $comments = Comment::factory(10)->create();

        $video->comments()->saveMany($comments);

        return $comments;
    }

    private static function associateParentCommentWith(Comment $comment)
    {
        if ($comment->replies->isNotEmpty()) return;

        return $comment->parent()->associate(static::findRandomCommentThatCanBeParentOf($comment))->save();
    }

    private static function findRandomCommentThatCanBeParentOf(Comment $comment)
    {
        return $comment->video
            ->comments()
            ->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()
            ->first();
    }
}
