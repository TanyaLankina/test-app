<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        Category::factory(6)
            ->sequence(
                ['order' => 1],
                ['order' => 2],
                ['order' => 3],
                ['order' => 4],
                ['order' => 5],
                ['order' => 6],
            )->has(Category::factory(3)
                ->sequence(
                    ['order' => 1],
                    ['order' => 2],
                    ['order' => 3],
                )->has(Category::factory(3)
                    ->sequence(
                        ['order' => 1],
                        ['order' => 2],
                        ['order' => 3]),
                    'subcategories'),
                'subcategories')->create();

        for ($i = 1; $i <= 5; $i++) {
            Product::factory(10)
                ->sequence(
                    ['order' => 1],
                    ['order' => 2],
                    ['order' => 3],
                )->create([
                    'category_id' => Category::all()->random()->id,
                ]);

            Product::factory(3)
                ->sequence(
                    ['order' => 1],
                    ['order' => 2],
                    ['order' => 3],
                )->create([
                    'category_id' => Category::all()->random()->id,
                ]);

            Product::factory(3)
                ->sequence(
                    ['order' => 1],
                    ['order' => 2],
                    ['order' => 3],
                )->create([
                    'category_id' => Category::all()->random()->id,
                ]);
        }


        Order::factory(300)->has(OrderItem::factory(5))->create();
    }
}
