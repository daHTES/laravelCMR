<?php

namespace App\Modules\Admin\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Passport\HasApiTokens;


class User extends AuthUser
{
    use HasFactory, HasApiTokens;


    //Поля которые показываем и выбираем
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'status',
    ];

    //Поля которые не показываем
    protected $hidden = [
        'password'
    ];
}
