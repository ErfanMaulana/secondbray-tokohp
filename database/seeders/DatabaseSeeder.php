<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Secondbray',
            'email' => 'admin@secondbray.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'User Demo',
            'email' => 'user@secondbray.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create Categories (Jenis HP)
        $categories = [
            ['name' => 'Flagship', 'slug' => 'flagship'],
            ['name' => 'Mid Range', 'slug' => 'mid-range'],
            ['name' => 'Gaming', 'slug' => 'gaming'],
            ['name' => 'Entry Level', 'slug' => 'entry-level'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Brands (Merek HP)
        $brands = [
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'iPhone', 'slug' => 'iphone'],
            ['name' => 'Oppo', 'slug' => 'oppo'],
            ['name' => 'Vivo', 'slug' => 'vivo'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'Realme', 'slug' => 'realme'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Create Sample Products
        $products = [
            [
                'category_id' => 1, // Flagship
                'brand_id' => 2, // iPhone
                'name' => 'iPhone 12 Pro Max',
                'slug' => 'iphone-12-pro-max',
                'price' => 8500000,
                'stock' => 5,
                'description' => 'iPhone 12 Pro Max 256GB. Kondisi sangat baik, mulus, fullset dengan box original.',
                'condition' => 'Excellent',
            ],
            [
                'category_id' => 2, // Mid Range
                'brand_id' => 2, // iPhone
                'name' => 'iPhone 11',
                'slug' => 'iphone-11',
                'price' => 5500000,
                'stock' => 8,
                'description' => 'iPhone 11 128GB. Kondisi bagus, normal, no minus.',
                'condition' => 'Good',
            ],
            [
                'category_id' => 1, // Flagship
                'brand_id' => 1, // Samsung
                'name' => 'Samsung Galaxy S21 Ultra',
                'slug' => 'samsung-galaxy-s21-ultra',
                'price' => 7200000,
                'stock' => 3,
                'description' => 'Samsung S21 Ultra 12/256GB. Kondisi mulus, garansi resmi habis.',
                'condition' => 'Excellent',
            ],
            [
                'category_id' => 2, // Mid Range
                'brand_id' => 1, // Samsung
                'name' => 'Samsung Galaxy A52',
                'slug' => 'samsung-galaxy-a52',
                'price' => 3200000,
                'stock' => 10,
                'description' => 'Samsung A52 8/128GB. Kondisi bagus, minus goresan halus.',
                'condition' => 'Good',
            ],
            [
                'category_id' => 3, // Gaming
                'brand_id' => 5, // Xiaomi
                'name' => 'Xiaomi Mi 11',
                'slug' => 'xiaomi-mi-11',
                'price' => 4500000,
                'stock' => 6,
                'description' => 'Xiaomi Mi 11 8/256GB. Kondisi bagus, lengkap dengan charger.',
                'condition' => 'Good',
            ],
            [
                'category_id' => 1, // Flagship
                'brand_id' => 3, // Oppo
                'name' => 'Oppo Find X3 Pro',
                'slug' => 'oppo-find-x3-pro',
                'price' => 6500000,
                'stock' => 4,
                'description' => 'Oppo Find X3 Pro 12/256GB. Kondisi sangat bagus, fullset.',
                'condition' => 'Excellent',
            ],
            [
                'category_id' => 2, // Mid Range
                'brand_id' => 4, // Vivo
                'name' => 'Vivo X60 Pro',
                'slug' => 'vivo-x60-pro',
                'price' => 5800000,
                'stock' => 5,
                'description' => 'Vivo X60 Pro 12/256GB. Kondisi bagus, kamera jernih.',
                'condition' => 'Good',
            ],
            [
                'category_id' => 4, // Entry Level
                'brand_id' => 6, // Realme
                'name' => 'Realme GT Master Edition',
                'slug' => 'realme-gt-master-edition',
                'price' => 3500000,
                'stock' => 12,
                'description' => 'Realme GT Master 8/128GB. Kondisi normal, performa tinggi.',
                'condition' => 'Fair',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
