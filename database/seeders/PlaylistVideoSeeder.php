<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Playlist::with('channel.videos')->each(
            fn (Playlist $playlist) => $playlist->videos()->saveMany($this->randomVideosFrom($playlist->channel))
        );
    }

    private function randomVideosFrom(Channel $channel): Collection
    {
        return $channel->videos->whenEmpty(
            fn () => collect(),
            fn (Collection $videos) => $videos->random(mt_rand(1, $videos->count()))
        );
    }
}
