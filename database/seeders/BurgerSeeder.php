<?php

namespace Database\Seeders;

use App\Models\Burger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BurgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Classic Beef Burger, Double Beef Deluxe, Black Angus Burger, Grilled Beef Supreme
        $burgers = [
            [
                'category_id' => 1,
                'name' => 'Classic Beef Burger',
                'description' => 'Juicy grilled beef patty with fresh lettuce, tomato, and our signature sauce.',
                'price' => 5000,
                'image' => 'img.png',
                'is_available'=> true,
                'stock'       => 50,
            ],
            [
                'category_id' => 2,
                'name' => 'Crispy Chicken Burger',
                'description' => 'Golden crispy chicken fillet with lettuce, cheese, and creamy mayo.',
                'price' => 7000,
                'image' => 'YqNceOUyUS2BSdidtmLOc9iuLhy8bFbgdY7wViVH.jpg',
                'is_available'=> true,
                'stock'       => 40,
            ],
            [
                'category_id' => 1,
                'name' => 'Double Beef Deluxe',
                'description' => 'Two juicy beef patties layered with cheese, onions, and smoky BBQ sauce.',
                'price' => 3500,
                'image' => 'pexels-jonathanborba-18713429.jpg',
                'stock'       => 30,
                'is_available'=> true,
            ],
            [
                'category_id' => 4,
                'name' => 'Italian Style Pizza',
                'description' => 'Authentic Italian pizza topped with fresh mozzarella, tomatoes, and basil.',
                'price' => 4590,
                'image' => 'pexels-valeriya-9328464.jpg',
                'is_available'=> true,
                'stock'       => 25,
            ],
            [
                'category_id' => 1,
                'name' => 'Black Angus Burger',
                'description' => 'Premium black bun burger with Angus beef, cheddar cheese, and special sauce.',
                'price' => 5990,
                'image' => 'pexels-taha-balta-3031128-4628428.jpg',
                'stock'       => 20,
                'is_available'=> true,
            ],
            [
                'category_id' => 3,
                'name' => 'Cheese Lover Burger',
                'description' => 'Loaded with melted cheese, juicy beef patty, and a rich creamy sauce.',
                'price' => 6770,
                'image' => 'B1SeoTJcNJFYL7dunQLTFb1LCYlmVFSjYGeBgeVL.jpg',
                'stock'       => 100,
                'is_available'=> true,
            ],
            [
                'category_id' => 2,
                'name' => 'Spicy Chicken Burger',
                'description' => 'Crispy chicken with spicy sauce, fresh lettuce, and pickles.',
                'price' => 6540,
                'image' => 'bB7BufJYRhUPadlegnnAGKd6DGBN10E64qL2OvU0.jpg',
                'stock'       => 10,
                'is_available'=> true,
            ],

            [
                'category_id' => 1,
                'name' => 'Grilled Beef Supreme',
                'description' => 'Flame-grilled beef with caramelized onions and house-made sauce.',
                'price' => 7890,
                'image' => 'Mo9jLEdEELcd7fBb9F57iGL3lxLa33MJ2UpRDRa7.jpg',
                'stock'       => 12,
                'is_available'=> true,
            ],

            [
                'category_id' => 4,
                'name' => 'Veggie Delight Pizza',
                'description' => 'Fresh vegetable pizza with olives, peppers, and melted cheese.',
                'price' => 8700,
                'image' => 'pexels-alla-zhuk-86841533-10153085.jpg',
                'stock'       => 9,
                'is_available'=> true,
            ],

            [
                'category_id' => 5,
                'name' => 'Gourmet Black Burger',
                'description' => 'Stylish black bun burger with premium beef and gourmet toppings.',
                'price' => 7000,
                'image' => 'pexels-christopher-welsch-leveroni-2150186467-32967539.jpg',
                'stock'       => 9,
                'is_available'=> true,
            ],
        ];

        foreach ($burgers as $burger) {
            Burger::create($burger);
        }
    }
}
