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
    // public function run()
    // {
    //     $categoryIds = Category::pluck('id')->all();
    //     $videoIds = Video::pluck('id')->all();

    //     $categoryVideo = [];

    //     foreach ($categoryIds as $categoryId) {
    //         $randomVideoIds = Arr::random($videoIds, mt_rand(1, count($videoIds)));

    //         foreach ($randomVideoIds as $videoId) {
    //             $categoryVideo[] = [
    //                 'category_id' => $categoryId,
    //                 'video_id' => $videoId,
    //             ];
    //         }
    //     }

    //     DB::table('category_video')->insert($categoryVideo);
    // }

    public function run()
    {
        $categoryIds = Category::pluck('id');
        $videoIds = Video::pluck('id');

        $categoryVideos = $categoryIds->flatMap(function (int $id) use ($videoIds) {
            $randomVideoIds = $videoIds->random(mt_rand(1, count($videoIds)));

            return $randomVideoIds->map(function (int $videoId) use ($id) {
                return [
                    'category_id' => $id,
                    'video_id' => $videoId,
                ];
            });
        });

        DB::table('category_video')->insert($categoryVideos->all());
    }
}
