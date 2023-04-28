<?php

namespace App\Modules\Admin\TaskComment\Policies;

use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskCommentPolicy{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function view(User $user){

        return $user->userPermissionSet(['Root_Admin', 'TASKS_COMMENT_VIEW']);

    }

    public function save(User $user){

        return $user->userPermissionSet(['Root_Admin', 'TASKS_COMMENT_CREATE']);

    }

    public function edit(User $user){

        return $user->userPermissionSet(['Root_Admin', 'TASKS_COMMENT_EDIT']);

    }

    public function delete(User $user){

        return $user->userPermissionSet(['Root_Admin', 'TASKS_COMMENT_EDIT']);

    }
}
