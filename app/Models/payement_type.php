<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payement_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'payementType',
    ];
}
