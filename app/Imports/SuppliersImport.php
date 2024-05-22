<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SuppliersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Supplier([
            'name' => $row['name'],
            'code' => $row['code'],
            'email' => $row['email'],
            'fax' => $row['fax'],
            'address' => $row['address'],
            'trn' => $row['trn'],
            'phone' => $row['phone'],
            'credit_period' => $row['credit_period'],
            'country_id' => $row['country_id'],
            'state_id' => $row['state_id'],
            'city_id' => $row['city_id'],
            'description' => $row['description'],
        ]);
    }


    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.code' => 'required|string|max:255|unique:suppliers,code',
            '*.email' => 'required|email|unique:suppliers,email',
            '*.fax' => 'nullable|max:255',
            '*.address' => 'nullable|string',
            '*.trn' => 'required|string|max:255|unique:suppliers,trn',
            '*.phone' => 'required|max:255|unique:suppliers,phone',
            '*.credit_period' => 'nullable|string|max:255',
            '*.country_id' => 'nullable|exists:countries,id',
            '*.state_id' => 'nullable|exists:states,id',
            '*.city_id' => 'nullable|exists:cities,id',
            '*.description' => 'nullable|string',
        ];
    }
}

