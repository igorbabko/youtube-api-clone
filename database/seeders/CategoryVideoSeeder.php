<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function runa()
    {
        $categoryIds = Category::pluck('id')->all();
        $videoIds = Video::pluck('id')->all();

        $categoryVideo = [];

        foreach ($categoryIds as $categoryId) {
            $randomVideoIds = Arr::random($videoIds, mt_rand(1, count($videoIds)));

            foreach ($randomVideoIds as $videoId) {
                $categoryVideo[] = [
                    'category_id' => $categoryId,
                    'video_id' => $videoId,
                ];
            }
        }

        DB::table('category_video')->insert($categoryVideo);
    }

    public function runb()
    {
        $videoIds = Video::pluck('id');
        $categoryIds = Category::pluck('id');

        $categoryVideo = $categoryIds->map(fn ($categoryId) => [
            'category_id' => $categoryId,
            'video_id' => $videoIds->random(),
        ]);

        DB::table('category_video')->insert($categoryVideo->all());
    }

    public function run()
    {
        $videoIds = Video::pluck('id');
        $categoryIds = Category::pluck('id');

        $categoryVideo = $categoryIds->flatMap(
            fn ($categoryId) => $videoIds->random(mt_rand(1, count($videoIds)))
                                         ->map(fn ($videoId) => [
                                             'category_id' => $categoryId,
                                             'video_id' => $videoId,
                                         ])
        );

        DB::table('category_video')->insert($categoryVideo->all());
    }
}
