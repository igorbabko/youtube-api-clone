<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];

        foreach (range(1, 3) as $i) {
            $users[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => "password$i"
            ];
        }

        DB::table('users')->insert($users);
    }
}
