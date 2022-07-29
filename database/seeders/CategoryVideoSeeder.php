<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
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
        $categoryIds = Category::pluck('id');
        $videoIds = Video::pluck('id');

        $categoryVideos = $categoryIds->flatMap(
          fn ($id) => $this->categoryVideos($id, $this->randomVideoIds($videoIds))
        );

        DB::table('category_video')->insert($categoryVideos->all());
    }

    private function categoryVideos(int $categoryId, Collection $videoIds): Collection
    {
        return $videoIds->map(fn ($id) => [
            'category_id' => $categoryId,
            'video_id' => $id,
        ]);
    }

    private function randomVideoIds(Collection $videoIds): Collection
    {
        return $videoIds->random(mt_rand(1, count($videoIds)));
    }
}
