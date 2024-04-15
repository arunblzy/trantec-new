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
        City::create(['name' => 'Los Angeles', 'state_id' => 1, 'country_id' => 1]);
        City::create(['name' => 'San Francisco', 'state_id' => 1, 'country_id' => 1]);
        City::create(['name' => 'New York City', 'state_id' => 2, 'country_id' => 1]);

        City::create(['name' => 'London', 'state_id' => 4, 'country_id' => 2]);
        City::create(['name' => 'Manchester', 'state_id' => 5, 'country_id' => 2]);
        City::create(['name' => 'Cardiff', 'state_id' => 6, 'country_id' => 2]);

        City::create(['name' => 'Toronto', 'state_id' => 7, 'country_id' => 3]);
        City::create(['name' => 'Montreal', 'state_id' => 8, 'country_id' => 3]);
        City::create(['name' => 'Vancouver', 'state_id' => 9, 'country_id' => 3]);
    }
}
