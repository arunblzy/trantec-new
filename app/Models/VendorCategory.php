<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_vendor_category', 'supplier_id', 'vendor_category_id');
    }
}
