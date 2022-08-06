<?php

namespace Database\Factories;

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
        $createdAt = $this->createdAt();

        return [
            'title' => ucfirst($this->faker->words(mt_rand(1, 2), true)),
            'description' => $this->faker->sentences(3, true),
            'channel_id' => Channel::inRandomOrder()->first(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    private function createdAt()
    {
        $period = $this->faker->randomElement(['year', 'month', 'week', 'day', 'hour']);

        return $this->faker->dateTimeBetween("-1 $period");
    }
}
