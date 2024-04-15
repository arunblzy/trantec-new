<?php

namespace Database\Seeders;

use App\Models\VendorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electrical'],
            ['name' => 'Hardware'],
            ['name' => 'Machines'],
            // Add more sample categories as needed
        ];

        foreach ($categories as $categoryData) {
            VendorCategory::create($categoryData);
        }
    }
}
