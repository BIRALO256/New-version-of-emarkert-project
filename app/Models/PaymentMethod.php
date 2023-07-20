<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table="payments_method";

    protected $fillable=[
        'user_id',
        'method_name',
        'bank_name',
        'bank_account_name',
        'bank_account_type',
        'bank_account_number',
        'mmoney_name',
        'mmoney_number',
        'bank_doc_path',
        'created_by',
        'updated_by',
    ];
}
