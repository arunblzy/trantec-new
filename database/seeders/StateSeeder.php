<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::create(['name' => 'California', 'country_id' => 1]);
        State::create(['name' => 'New York', 'country_id' => 1]);
        State::create(['name' => 'Texas', 'country_id' => 1]);

        State::create(['name' => 'England', 'country_id' => 2]);
        State::create(['name' => 'Scotland', 'country_id' => 2]);
        State::create(['name' => 'Wales', 'country_id' => 2]);

        State::create(['name' => 'Ontario', 'country_id' => 3]);
        State::create(['name' => 'Quebec', 'country_id' => 3]);
        State::create(['name' => 'British Columbia', 'country_id' => 3]);
    }
}
