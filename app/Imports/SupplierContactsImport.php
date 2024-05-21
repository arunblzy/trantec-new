<?php
namespace App\Imports;

use App\Models\SupplierContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SupplierContact([
            'supplier_id' => $row['supplier_id'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'description' => $row['description'],
            'mobile' => $row['mobile'],
            'fax' => $row['fax'],
        ]);
    }
}
