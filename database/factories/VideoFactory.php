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
        $createdAt = $this->faker->dateTimeThisYear();
        // $createdAt = $this->faker->dateTimeThisMonth();
        // $createdAt = $this->faker->dayOfWeek();
        // $createdAt = $this->faker->dateTimeBetween('-2 months', '+1 week');
        // $createdAt = $this->faker->dateTimeInInterval('-1 week', '+3 days');

        // $createdAt = $this->faker->dateTimeBetween('-1 year');
        // $createdAt = $this->faker->dateTimeBetween('-1 month');
        // $createdAt = $this->faker->dateTimeBetween('-1 week');
        // $createdAt = $this->faker->dateTimeBetween('-1 day');
        // $createdAt = $this->faker->dateTimeBetween('-1 hour');

        return [
            'title' => ucfirst($this->faker->words(mt_rand(1, 2), true)),
            'channel_id' => Channel::inRandomOrder()->first(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
