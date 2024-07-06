<?php

namespace Database\Seeders;

use App\Models\Objective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Objective::create(["name"=>"Master the Essentials"]);
        Objective::create(["name"=>"Boost you Skills"]);
        Objective::create(["name"=>"Tech Professionals"]);

    }
}
