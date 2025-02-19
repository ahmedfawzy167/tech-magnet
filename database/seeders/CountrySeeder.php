<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Egypt', 'code' => 'EG', 'phone_code' => '+20'],
            ['name' => 'United States', 'code' => 'US', 'phone_code' => '+1'],
            ['name' => 'United Kingdom', 'code' => 'UK', 'phone_code' => '+44'],
            ['name' => 'India', 'code' => 'IN', 'phone_code' => '+91'],
            ['name' => 'Canada', 'code' => 'CA', 'phone_code' => '+1'],
            ['name' => 'Australia', 'code' => 'AU', 'phone_code' => '+61'],
            ['name' => 'Germany', 'code' => 'DE', 'phone_code' => '+49'],
            ['name' => 'France', 'code' => 'FR', 'phone_code' => '+33'],
            ['name' => 'Italy', 'code' => 'IT', 'phone_code' => '+39'],
            ['name' => 'Spain', 'code' => 'ES', 'phone_code' => '+34'],
            ['name' => 'Brazil', 'code' => 'BR', 'phone_code' => '+55'],
            ['name' => 'Mexico', 'code' => 'MX', 'phone_code' => '+52'],
            ['name' => 'Argentina', 'code' => 'AR', 'phone_code' => '+54'],
            ['name' => 'Russia', 'code' => 'RU', 'phone_code' => '+7'],
            ['name' => 'China', 'code' => 'CN', 'phone_code' => '+86'],
            ['name' => 'Japan', 'code' => 'JP', 'phone_code' => '+81'],
            ['name' => 'South Korea', 'code' => 'KR', 'phone_code' => '+82'],
            ['name' => 'South Africa', 'code' => 'ZA', 'phone_code' => '+27'],
            ['name' => 'Nigeria', 'code' => 'NG', 'phone_code' => '+234'],
            ['name' => 'Kenya', 'code' => 'KE', 'phone_code' => '+254'],
            ['name' => 'Turkey', 'code' => 'TR', 'phone_code' => '+90'],
            ['name' => 'Saudi Arabia', 'code' => 'SA', 'phone_code' => '+966'],
            ['name' => 'United Arab Emirates', 'code' => 'AE', 'phone_code' => '+971'],
            ['name' => 'Sweden', 'code' => 'SE', 'phone_code' => '+46'],
            ['name' => 'Norway', 'code' => 'NO', 'phone_code' => '+47'],
            ['name' => 'Finland', 'code' => 'FI', 'phone_code' => '+358'],
            ['name' => 'Denmark', 'code' => 'DK', 'phone_code' => '+45'],
            ['name' => 'Poland', 'code' => 'PL', 'phone_code' => '+48'],
            ['name' => 'Netherlands', 'code' => 'NL', 'phone_code' => '+31'],
            ['name' => 'Belgium', 'code' => 'BE', 'phone_code' => '+32'],
            ['name' => 'Switzerland', 'code' => 'CH', 'phone_code' => '+41'],
            ['name' => 'Austria', 'code' => 'AT', 'phone_code' => '+43'],
            ['name' => 'Portugal', 'code' => 'PT', 'phone_code' => '+351'],
            ['name' => 'Greece', 'code' => 'GR', 'phone_code' => '+30'],
            ['name' => 'Czech Republic', 'code' => 'CZ', 'phone_code' => '+420'],
            ['name' => 'Hungary', 'code' => 'HU', 'phone_code' => '+36'],
            ['name' => 'Romania', 'code' => 'RO', 'phone_code' => '+40'],
            ['name' => 'Bulgaria', 'code' => 'BG', 'phone_code' => '+359'],
            ['name' => 'Croatia', 'code' => 'HR', 'phone_code' => '+385'],
            ['name' => 'Slovakia', 'code' => 'SK', 'phone_code' => '+421'],
            ['name' => 'Slovenia', 'code' => 'SI', 'phone_code' => '+386'],
            ['name' => 'Ireland', 'code' => 'IE', 'phone_code' => '+353'],
            ['name' => 'New Zealand', 'code' => 'NZ', 'phone_code' => '+64'],
            ['name' => 'Israel', 'code' => 'IL', 'phone_code' => '+972'],
            ['name' => 'Indonesia', 'code' => 'ID', 'phone_code' => '+62'],
            ['name' => 'Malaysia', 'code' => 'MY', 'phone_code' => '+60'],
            ['name' => 'Singapore', 'code' => 'SG', 'phone_code' => '+65'],
            ['name' => 'Thailand', 'code' => 'TH', 'phone_code' => '+66'],
            ['name' => 'Vietnam', 'code' => 'VN', 'phone_code' => '+84'],
            ['name' => 'Peru', 'code' => 'PE', 'phone_code' => '+51'],
        ];

        foreach ($countries as $country) {
            Country::UpdateOrCreate($country);
        }
    }
}
