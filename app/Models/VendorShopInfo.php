<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorShopInfo extends Model
{
    use HasFactory;

    protected $table="vendors_shop_information";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable=[
        'user_id',
        'shop_name',
        'contact_name',
        'email_address',
        'contact_phone1',
        'contact_phone2',
        'address_line1',
        'address_line2',
        'city_town',
        'state_region',
        'country',
        'postal_code',
        'created_by',
        'updated_by',
    ];
}
