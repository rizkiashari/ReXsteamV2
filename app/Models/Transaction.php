<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['uuid_transaction', 'user_id', 'card_name', 'card_number', 'expired_month', 'expired_year', 'cvc_cvv', 'card_country', 'postal_code', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
