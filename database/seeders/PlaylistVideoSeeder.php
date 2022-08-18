<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Playlist;
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
        $playlists = Playlist::all();

        $playlistVideos = $playlists->flatMap(
          fn ($playlist) => $this->playlistVideos($playlist, $this->randomVideosFrom($playlist->channel))
        );

        DB::table('playlist_video')->insert($playlistVideos->all());
    }

    private function playlistVideos(Playlist $playlist, Collection $videos): Collection
    {
        return $videos->map(fn ($video) => [
            'playlist_id' => $playlist->id,
            'video_id' => $video->id,
        ]);
    }

    private function randomVideosFrom(Channel $channel): Collection
    {
        return $channel->videos->random(mt_rand(1, count($channel->videos)));
    }
}
