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
            'name' => 'Perforated White Platform Slip-On Sneakers',
            'brand' => 'Flexaura Shoes',
            'description' => 'White laser-cut slip-on sneakers with a hidden platform sole.',
            'price' => 89.99,
            'image' => 'fw1.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Double-Strap Mary Jane Shoes',
            'brand' => 'Flexaura Shoes',
            'description' => 'Glossy burgundy Mary Janes with chunky lug soles.',
            'price' => 95.00,
            'image' => 'fw2.jpg',
            'rating' => 4,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Laser-Cut Breathable High-Top Sneakers',
            'brand' => 'Flexaura Shoes',
            'description' => 'Beige high-top sneakers with geometric cutouts and side zip.',
            'price' => 120.00,
            'image' => 'fw3.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Classic Brown Derby Leather Shoes',
            'brand' => 'Flexaura Shoes',
            'description' => 'Handcrafted chocolate brown derby shoes with polished finish.',
            'price' => 150.00,
            'image' => 'fw4.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Chunky High-Top Platform Sneakers',
            'brand' => 'Flexaura Shoes',
            'description' => 'Bold dad-shoe style high-tops with sculpted white midsole.',
            'price' => 110.00,
            'image' => 'fw5.jpg',
            'rating' => 4,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Platform Fisherman Lace-Up Shoes',
            'brand' => 'Flexaura Shoes',
            'description' => 'Cognac leather fisherman shoes on a cream platform sole.',
            'price' => 125.00,
            'image' => 'fw6.jpg',
            'rating' => 5,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Pebbled Leather Ankle Boots',
            'brand' => 'Flexaura Shoes',
            'description' => 'Brown pebbled leather lace-up ankle boots with contrast stitching.',
            'price' => 99.00,
            'image' => 'fw7.jpg',
            'rating' => 4,
            'category' => 'footwear'
        ]);
        Product::create([
            'name' => 'Green Platform High-Top Boots',
            'brand' => 'Flexaura Shoes',
            'description' => 'Forest green and black platform boots with heart cutout panels.',
            'price' => 135.00,
            'image' => 'fw8.jpg',
            'rating' => 5,
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
