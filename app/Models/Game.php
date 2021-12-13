<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'game_name', 'slug', 'description', 'long_description', 'developer', 'publisher', 'price', 'cover', 'trailer', 'is_adult', 'release_date'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
