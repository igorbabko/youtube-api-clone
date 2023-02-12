<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Video::limit(10)->get()
            ->flatMap
            ->createRandomComments()
            ->each
            ->associateParentComment();
    }
}
