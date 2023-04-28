<?php


namespace App\Modules\Admin\Task\Policies;


use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy{
    use HandlesAuthorization;

    public function __construct(){
        //
    }

    public function view(User $user){

        return $user->userPermissionSet(['Root_Admin', 'TASKS_VIEW']);
    }

    public function save(User $user){

        return $user->userPermissionSet(['Root_Admin','TASKS_CREATE']);
    }

    public function edit(User $user){

        return $user->userPermissionSet(['Root_Admin','TASKS_EDIT']);
    }

    public function delete(User $user){

        return $user->userPermissionSet(['Root_Admin','TASKS_EDIT']);
    }




}
