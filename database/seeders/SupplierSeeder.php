<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['name' => 'Supplier 1', 'email' => 'supplier1@example.com', 'phone' => '123456789'],
            ['name' => 'Supplier 2', 'email' => 'supplier2@example.com', 'phone' => '987654321'],
            // Add more sample suppliers as needed
        ];

        foreach ($suppliers as $supplierData) {
            Supplier::create($supplierData);
        }
    }
}
