<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Video::take(10)
            ->get()
            ->flatMap(fn (Video $video) => $this->forVideo($video))
            ->each(fn (Comment $comment) => $this->repliesOf($comment));
    }

    private function forVideo(Video $video)
    {
        return Comment::factory(5)->for($video)->create();
    }

    private function repliesOf(Comment $comment)
    {
        Comment::factory(5)->for($comment->video)->for($comment, 'parent')->create();
    }
}
