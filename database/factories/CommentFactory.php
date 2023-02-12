<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'text' => fake()->sentences(mt_rand(1, 3), true),
            'parent_id' => null,
            'user_id' => User::inRandomOrder()->first(),
            'video_id' => Video::inRandomOrder()->first(),
        ];
    }
}
