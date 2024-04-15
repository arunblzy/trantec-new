<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'email',
        'fax',
        'address',
        'trn',
        'phone',
        'credit_period',
        'country',
        'city',
        'state',
        'description',
    ];

    public function vendorCategories()
    {
        return $this->belongsToMany(VendorCategory::class, 'supplier_vendor_category', 'supplier_id', 'category_id');
    }
}
