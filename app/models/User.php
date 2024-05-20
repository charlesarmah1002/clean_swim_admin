<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'country_code',
        'phone',
        'password',
        'profile_image'
    ];
}
