<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(["name" => "Web Development"]);
        Category::create(["name" => "Data Science"]);
        Category::create(["name" => "Mobile Apps"]);
        Category::create(["name" => "Networks"]);
        Category::create(["name" => "Design"]);
        Category::create(["name" => "Digital Marketing"]);
        Category::create(["name" => "AI and Machine Learning"]);
        Category::create(["name" => "DevOps"]);
        Category::create(["name" => "CyberSecurity"]);
        Category::create(["name" => "Cloud Computing"]);
    }
}
