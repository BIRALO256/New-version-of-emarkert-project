<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_subcategory extends Model
{
    use HasFactory;
    
    protected $table = 'product_subcategorys';
    
    protected $fillable = [
        'name',
        'product_category_id',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(categorie::class);
    }
    
}
