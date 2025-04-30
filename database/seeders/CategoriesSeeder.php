<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'DuDu'],
            ['name' => 'Sanrio'],
            ['name' => 'Capybara'],
            ['name' => 'Shaun The Sheep'],
        ]);
    }
}
