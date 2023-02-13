<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Video::take(10)->get()->each(fn (Video $video) => $this->forVideo($video));
    }

    private function forVideo(Video $video)
    {
        Comment::factory(5)->for($video)->create()->each(
            fn (Comment $comment) => $this->repliesOf($comment)
        );
    }

    private function repliesOf(Comment $comment)
    {
        Comment::factory(5)->for($comment->video)->for($comment, 'parent')->create();
    }
}
