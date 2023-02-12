<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Video::limit(1)->get()->each(
            fn ($video) => Comment::factory(10)->create(['video_id' => $video->id])
        );
    }
}
