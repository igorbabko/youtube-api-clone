<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlistIds = Playlist::pluck('id');
        $videoIds = Video::pluck('id');

        $playlistVideos = $playlistIds->flatMap(
            fn (int $id) => $this->playlistVideos($id, $this->randomVideoIds($videoIds))
        );

        DB::table('playlist_video')->insert($playlistVideos->all());
    }

    private function playlistVideos(int $playlistId, Collection $videoIds): Collection
    {
        return $videoIds->map(fn (int $id) => [
            'playlist_id' => $playlistId,
            'video_id' => $id,
        ]);
    }

    private function randomVideoIds(Collection $ids): Collection
    {
        return $ids->random(mt_rand(1, count($ids)));
    }
}
