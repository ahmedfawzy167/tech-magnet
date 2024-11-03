<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'user_id' => 11,
            'city_id' => 5,
            'address' => 'El Mohandesin',
        ]);

        Address::create([
            'user_id' => 14,
            'city_id' => 5,
            'address' => 'Sheraton',
        ]);
    }
}
