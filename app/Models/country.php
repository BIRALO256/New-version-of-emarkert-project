<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table = 'countrys';

    protected $fillable = [
        'countryname',
    ];
    use HasFactory;
}
