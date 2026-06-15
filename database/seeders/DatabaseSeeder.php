<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
            ]
        );

        $category = Category::firstOrCreate(
            ['name' => 'General'],
            [
                'description' => 'Default product category',
                'is_active' => true,
            ]
        );

        Product::firstOrCreate(
            ['name' => 'Sample Product'],
            [
                'category_id' => $category->id,
                'price' => 10.00,
                'stock' => 25,
                'is_active' => true,
            ]
        );
    }
}
