<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wishlist::create([
            "course_id" => 15,
            "user_id" => 29,
        ]);

        Wishlist::create([
            "course_id" => 1,
            "user_id" => 29,
        ]);

        Wishlist::create([
            "course_id" => 12,
            "user_id" => 28,
        ]);

        Wishlist::create([
            "course_id" => 6,
            "user_id" => 12,
        ]);
    }
}
