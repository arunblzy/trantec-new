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
        'country_id',
        'city_id',
        'state_id',
    ];

    public function vendorCategories()
    {
        return $this->belongsToMany(VendorCategory::class, 'supplier_vendor_category', 'supplier_id', 'vendor_category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
