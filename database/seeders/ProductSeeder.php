<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => 'Gấu bông',
                'slug' => 'gaubong',
                'price' => rand(300000, 500000),
                'description' => 'Wonderful',
                'image' => 'images/capybara.png',
                'category_id' => '1'
            ]);
        }
    }
}
