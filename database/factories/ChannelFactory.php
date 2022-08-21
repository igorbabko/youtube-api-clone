<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => ucfirst(fake()->words(mt_rand(1, 2), true)),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
