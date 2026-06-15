<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 8; $i++) {
            Product::create([
                'name' => 'Cartoon Astronaut T-Shirts ' . $i,
                'brand' => 'adidas',
                'description' => 'A comfortable and stylish t-shirt for all your needs.',
                'price' => 78.00,
                'image' => 'f' . $i . '.jpg',
                'rating' => rand(3, 5),
                'category' => 'featured'
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Product::create([
                'name' => 'Summer Collection T-Shirts ' . $i,
                'brand' => 'adidas',
                'description' => 'A comfortable and stylish summer t-shirt.',
                'price' => 78.00,
                'image' => 'n' . $i . '.jpg',
                'rating' => rand(3, 5),
                'category' => 'new_arrival'
            ]);
        }
    }
}
