<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id', 'username', 'fullname', 'password',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
