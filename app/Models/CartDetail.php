<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id', 'game_id', 'is_available'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
