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
        $cities = [
            ["name" => "Alexandria", "country_id" => 1],
            ["name" => "Aswan", "country_id" => 1],
            ["name" => "Beheira", "country_id" => 1],
            ["name" => "Assiut", "country_id" => 1],
            ["name" => "Cairo", "country_id" => 1],
            ["name" => "Daqahliya", "country_id" => 1],
            ["name" => "Damietta", "country_id" => 1],
            ["name" => "Fayoum", "country_id" => 1],
            ["name" => "Gharbiya", "country_id" => 1],
            ["name" => "Helwan", "country_id" => 1],
            ["name" => "Ismailia", "country_id" => 1],
            ["name" => "Kafr El Sheikh", "country_id" => 1],
            ["name" => "Luxor", "country_id" => 1],
            ["name" => "Bani Suef", "country_id" => 1],
            ["name" => "Minya", "country_id" => 1],
            ["name" => "Monofiya", "country_id" => 1],
            ["name" => "North Sinai", "country_id" => 1],
            ["name" => "Giza", "country_id" => 1],
            ["name" => "Port Said", "country_id" => 1],
            ["name" => "Qalioubiya", "country_id" => 1],
            ["name" => "Qena", "country_id" => 1],
            ["name" => "Marsa Matrouh", "country_id" => 1],
            ["name" => "Sharqiya", "country_id" => 1],
            ["name" => "New Valley", "country_id" => 1],
            ["name" => "Sohag", "country_id" => 1],
            ["name" => "Red Sea", "country_id" => 1],
            ["name" => "Suez", "country_id" => 1],
            ["name" => "South Sinai", "country_id" => 1],
            ["name" => "Tanta", "country_id" => 1],

            ["name" => "Borg El Arab", "country_id" => 1],
            ["name" => "6th of October", "country_id" => 1],
            ["name" => "Shubra El Kheima", "country_id" => 1],
            ["name" => "10th of Ramadan", "country_id" => 1],
            ["name" => "Zagazig", "country_id" => 1],
            ["name" => "Mansoura", "country_id" => 1],
            ["name" => "Damanhur", "country_id" => 1],
            ["name" => "Banha", "country_id" => 1],
            ["name" => "Mallawi", "country_id" => 1],
            ["name" => "El-Mahalla El-Kubra", "country_id" => 1],
            ["name" => "Kafr El Dawwar", "country_id" => 1],
            ["name" => "Sidi Barrani", "country_id" => 1],
            ["name" => "Qus", "country_id" => 1],
            ["name" => "Arish", "country_id" => 1],
            ["name" => "Hurghada", "country_id" => 1],
            ["name" => "Sharm El Sheikh", "country_id" => 1],
            ["name" => "El Gouna", "country_id" => 1],
            ["name" => "Safaga", "country_id" => 1],
            ["name" => "Dahab", "country_id" => 1],
            ["name" => "El Tor", "country_id" => 1],
            ["name" => "Bilbays", "country_id" => 1],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
