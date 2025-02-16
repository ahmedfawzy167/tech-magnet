<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Homepage Top'],
            ['name' => 'Homepage Sidebar'],
            ['name' => 'Course Page Header'],
            ['name' => 'Footer Banner'],
            ['name' => 'Popup Modal'],
        ];

        DB::table('locations')->insert($locations);
    }
}
