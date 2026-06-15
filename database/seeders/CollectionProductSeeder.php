<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class CollectionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Winter / Sale Category (50% off prices)
        Product::create([
            'name' => 'Luxury Down Winter Jacket',
            'brand' => 'Flexaura Winter',
            'description' => 'Premium luxury down jacket keeping you warm up to -20°C.',
            'price' => 149.99, // Assuming original was ~300
            'image' => 'f1.jpg',
            'rating' => 5,
            'category' => 'winter'
        ]);
        Product::create([
            'name' => 'Woolen Plaid Shawl',
            'brand' => 'Flexaura Winter',
            'description' => 'Elegant woolen shawl for chilly evenings.',
            'price' => 39.50,
            'image' => 'f2.jpg',
            'rating' => 4,
            'category' => 'winter'
        ]);
        Product::create([
            'name' => 'Thermal Winter Coat',
            'brand' => 'Flexaura Winter',
            'description' => 'High-performance thermal coat.',
            'price' => 99.00,
            'image' => 'f3.jpg',
            'rating' => 5,
            'category' => 'winter'
        ]);
        Product::create([
            'name' => 'Cashmere Winter Scarf',
            'brand' => 'Flexaura Winter',
            'description' => 'Soft 100% cashmere scarf.',
            'price' => 45.00,
            'image' => 'f4.jpg',
            'rating' => 4,
            'category' => 'winter'
        ]);

        // Footwear Category
        Product::create([
            'name' => 'Classic Leather Sneakers',
            'brand' => 'Flexaura Shoes',
            'description' => 'Everyday classic white leather sneakers.',
            'price' => 89.99,
            'image' => 'n1.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Runner Pro Active Shoes',
            'brand' => 'Flexaura Shoes',
            'description' => 'Lightweight running shoes for active lifestyle.',
            'price' => 120.00,
            'image' => 'n2.jpg',
            'rating' => 4,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Formal Oxford Leather Shoes',
            'brand' => 'Flexaura Shoes',
            'description' => 'Elegant formal shoes for business wear.',
            'price' => 150.00,
            'image' => 'n3.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Casual Slip-on Loafers',
            'brand' => 'Flexaura Shoes',
            'description' => 'Comfortable slip-on loafers for weekend wear.',
            'price' => 75.00,
            'image' => 'n4.jpg',
            'rating' => 4,
            'category' => 'footwear'
        ]);

        // T-Shirts Category
        Product::create([
            'name' => 'Dynamic Graphic T-Shirt',
            'brand' => 'Flexaura Basics',
            'description' => '100% cotton t-shirt with modern graphic print.',
            'price' => 25.00,
            'image' => 'f5.jpg',
            'rating' => 5,
            'category' => 'tshirts'
        ]);
        Product::create([
            'name' => 'Vintage Logo T-Shirt',
            'brand' => 'Flexaura Basics',
            'description' => 'Classic vintage logo printed t-shirt.',
            'price' => 22.50,
            'image' => 'f6.jpg',
            'rating' => 4,
            'category' => 'tshirts'
        ]);
        Product::create([
            'name' => 'Premium Essential V-Neck',
            'brand' => 'Flexaura Basics',
            'description' => 'Premium essential v-neck tee for everyday comfort.',
            'price' => 28.00,
            'image' => 'f7.jpg',
            'rating' => 5,
            'category' => 'tshirts'
        ]);
        Product::create([
            'name' => 'Oversized Streetwear T-Shirt',
            'brand' => 'Flexaura Basics',
            'description' => 'Trendy oversized fit t-shirt.',
            'price' => 35.00,
            'image' => 'f8.jpg',
            'rating' => 5,
            'category' => 'tshirts'
        ]);
    }
}
