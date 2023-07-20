<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBusinessInfo extends Model
{
    use HasFactory;

    protected $table="vendor_business_info";

    protected $fillable=[
        'user_id',
        'owner_name',
        'id_type',
        'id_number',
        'id_attach_url',
        'address1',
        'address2',
        'city_town',
        'state_region',
        'country',
        'postal_code',
        'created_by',
        'updated_by',
    ];
}
