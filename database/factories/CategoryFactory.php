<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => ucfirst(fake()->words(mt_rand(1, 2), true)),
        ];
    }
}
