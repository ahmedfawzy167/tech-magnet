<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create([
            "course_id" => 7,
            "user_id" => 29,
            "quantity" => 5,
        ]);

        Cart::create([
            "course_id" => 3,
            "user_id" => 29,
            "quantity" => 2,
        ]);

        Cart::create([
            "course_id" => 4,
            "user_id" => 27,
            "quantity" => 6,
        ]);

        Cart::create([
            "course_id" => 2,
            "user_id" => 29,
            "quantity" => 3,
        ]);

        Cart::create([
            "course_id" => 9,
            "user_id" => 11,
            "quantity" => 4,
        ]);
    }
}
