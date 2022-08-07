<?php

namespace Database\Seeders;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(Period::cases())
            ->each(fn (Period $period) => Video::factory(20)->last($period)->create());
    }
}
