<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id', 'username', 'fullname', 'password', 'photo', 'level',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
