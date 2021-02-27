<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address'
    ];
    protected $hidden = [
        'password'
    ];
    public $timestamps = false;
}
