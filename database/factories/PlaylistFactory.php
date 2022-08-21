<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => ucfirst(fake()->words(mt_rand(1, 2), true)),
            'channel_id' => Channel::inRandomOrder()->first(),
        ];
    }
}
