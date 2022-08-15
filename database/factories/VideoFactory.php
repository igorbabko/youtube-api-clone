<?php

namespace Database\Factories;

use App\Enums\Period;
use App\Models\Channel;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => ucfirst(fake()->words(mt_rand(1, 2), true)),
            'description' => fake()->sentences(mt_rand(1, 3), true),
            'channel_id' => Channel::inRandomOrder()->first(),
        ];
    }

    public function last(Period $period)
    {
        return $this->state(function () use ($period) {
            $createdAt = fake()->dateTimeBetween("-1 $period->value");

            return [
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        });
    }
}
