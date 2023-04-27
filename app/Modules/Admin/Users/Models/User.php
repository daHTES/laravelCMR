<?php

namespace App\Modules\Admin\Users\Models;

use App\Modules\Admin\Lead\Models\Traits\UserLeadsTrait;
use App\Modules\Admin\Role\Models\Traits\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Passport\HasApiTokens;


class User extends AuthUser
{
    use HasFactory, HasApiTokens, UserRoles, UserLeadsTrait;


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
