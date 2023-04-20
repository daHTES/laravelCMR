<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 26.12.2020
 * Time: 10:41
 */

namespace App\Modules\Admin\Users\Services;


use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Users\Models\User;
use App\Modules\Admin\Users\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getUsers($status = false)
    {

        $usersBulder = User::with('roles');

        if($status) {
            $usersBulder->where('status',(string)$status);
        }

        $users = $usersBulder->get();
        $users->transform(function($item) {
            $item->rolename = '';
            if(isset($item->roles)) {
                $item->rolename = isset($item->roles->first()->title) ? $item->roles->first()->title : "";
            }

            return $item;
        });

        return $users;
    }

    public function save(UserRequest $request, User $user){

        $user->fill($request->only($user->getFillable()));

        $user->password = Hash::make($request->password);
        $user->status = '1';

        $user->save();

        $role = Role::findOrFail($request->role_id);
        $user->roles()->sync($role->id);

        $user->rolename = $role->title;

        return $user;
    }

}
