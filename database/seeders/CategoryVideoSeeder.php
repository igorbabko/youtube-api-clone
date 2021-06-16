<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryVideo = [];

        foreach (range(1, 3) as $i) {
            $categoryVideo[] = [
                'category_id' => $i,
                'video_id' => $i
            ];
        }

        DB::table('category_video')->insert($categoryVideo);
    }
}
