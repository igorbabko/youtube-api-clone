<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ChannelSeeder::class,
            PlaylistSeeder::class,
            VideoSeeder::class,
            CategorySeeder::class,
            CategoryVideoSeeder::class,
            PlaylistVideoSeeder::class,
        ]);
    }
}
