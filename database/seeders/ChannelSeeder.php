<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        Channel::factory(40)
            ->sequence(fn ($sequence) => ['user_id' => $sequence->index + 1])
            ->create();
    }
}
