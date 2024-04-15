<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'phone',
        'email',
        'description',
        'mobile',
        'fax',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

}
