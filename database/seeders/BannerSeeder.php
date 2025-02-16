<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            ['name' => 'Homepage Banner'],
            ['name' => 'Course Promotion Banner'],
            ['name' => 'Discount Offer Banner'],
            ['name' => 'Webinar Announcement Banner'],
            ['name' => 'Student Achievement Banner'],
        ];

        DB::table('banners')->insert($banners);
    }
}
