<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(["name"=>"Alexandria"]);
        City::create(["name"=>"Aswan"]);
        City::create(["name"=>"Beheira"]);
        City::create(["name"=>"Assiut"]);
        City::create(["name"=>"Cairo"]);
        City::create(["name"=>"Daqahliya"]);
        City::create(["name"=>"Damietta"]);
        City::create(["name"=>"Fayoum"]);
        City::create(["name"=>"Gharbiya"]);
        City::create(["name"=>"Helwan"]);
        City::create(["name"=>"Ismailia"]);
        City::create(["name"=>"Kafr El Sheikh"]);
        City::create(["name"=>"Luxor"]);
        City::create(["name"=>"Bani Suef"]);
        City::create(["name"=>"Minya"]);
        City::create(["name"=>"Monofiya"]);
        City::create(["name"=>"North Sinai"]);
        City::create(["name"=>"Giza"]);
        City::create(["name"=>"Port Said"]);
        City::create(["name"=>"Qalioubiya"]);
        City::create(["name"=>"Qena"]);
        City::create(["name"=>"Marsa Matrouh"]);
        City::create(["name"=>"Sharqiya"]);
        City::create(["name"=>"New Valley"]);
        City::create(["name"=>"Sohag"]);
        City::create(["name"=>"Red Sea"]);
        City::create(["name"=>"Suez"]);
        City::create(["name"=>"South Sinai"]);
        City::create(["name"=>"Tanta"]);
    }
}
