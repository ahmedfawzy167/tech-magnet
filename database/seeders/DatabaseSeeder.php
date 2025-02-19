<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roadmap;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoadmapSeeder::class,
            AddressSeeder::class,
            CartSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
