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
        for ($i = 1; $i <= 2; $i++) {
            Product::create([
                'name' => 'Sticky Chicken Rice Bowls',
                'price' => 100000,
                'description' => 'A delicious and versatile chicken recipe that combines tender',
                'image' => 'https://i.pinimg.com/736x/cd/1f/18/cd1f185753d535325b3d69c1e8fc71ba.jpg',
                'category_id' => '1'
            ]);
        }
    }
}
