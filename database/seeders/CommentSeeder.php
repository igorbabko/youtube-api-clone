<?php

namespace Database\Seeders;

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
            ->flatMap
            ->createRandomComments()
            ->each
            ->associateParentComment();
    }
}
