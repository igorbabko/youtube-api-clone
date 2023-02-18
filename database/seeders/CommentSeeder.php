<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::take(3)->get()
            ->flatMap(fn (Video $video) => static::seedCommentsFor($video))
            ->each(fn (Comment $comment) => static::associateParentCommentWith($comment));
    }

    private static function seedCommentsFor(Video $video)
    {
        $comments = Comment::factory(10)->create();

        $video->comments()->saveMany($comments);

        return $comments;
    }

    private static function associateParentCommentWith(Comment $comment)
    {
        if ($comment->replies->isNotEmpty()) {
            return;
        }

        $comment->parent()->associate(static::findRandomCommentThatCanBeParentOf($comment))->save();
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
