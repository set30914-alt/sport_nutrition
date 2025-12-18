<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Якщо ще нема категорій — створимо
        $categories = Category::pluck('id')->toArray();

        if (empty($categories)) {
            $categories = Category::insert([
                ['name' => 'Протеїн', 'description' => 'Протеїнові добавки'],
                ['name' => 'Амінокислоти', 'description' => 'BCAA, EAA та ін.'],
                ['name' => 'Креатин', 'description' => 'Моногідрат та ін.'],
                ['name' => 'Вітаміни', 'description' => 'Спортивні комплекси'],
            ]);

            $categories = Category::pluck('id')->toArray();
        }

        $images = [
            'test1.jpg',
            'test2.jpg',
            'test3.jpg',
            'test4.jpg'
        ];

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => 'Тестовий товар #' . $i,
                'description' => Str::random(120),
                'price' => rand(200, 1500),
                'category_id' => $categories[array_rand($categories)],
                'image' => 'products/' . $images[array_rand($images)],
            ]);
        }
    }
}
