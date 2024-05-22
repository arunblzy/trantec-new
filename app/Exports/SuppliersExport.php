<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuppliersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = [];
        for($i = 1; $i <= 5000; $i++){
            $unique = uniqid('', true);
            $data[] = [
                'name' => 'Supplier '.$unique,
                'code' => 'SUP001'.$unique,
                'email' => 'supplier'.$unique.'@example.com',
                'fax' => '123456789',
                'address' => '123 Supplier Street,'.$unique,
                'trn' => 'TRN001'.strtoupper($unique),
                'phone' => '98765432'.str_pad($i, '2', '0', STR_PAD_LEFT),
                'credit_period' => '30 days',
                'country_id' => 2,
                'state_id' => 4,
                'city_id' => 4,
                'description' => 'supplier - '.$unique,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'name',
            'code',
            'email',
            'fax',
            'address',
            'trn',
            'phone',
            'credit_period',
            'country_id',
            'state_id',
            'city_id',
            'description',
        ];
    }
}
