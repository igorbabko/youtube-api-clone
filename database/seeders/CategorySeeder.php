<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        foreach (range(1, 3) as $i) {
            $categories[] = [
                'name' => "Category $i"
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
