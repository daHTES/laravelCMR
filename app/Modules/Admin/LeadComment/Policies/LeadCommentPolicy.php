<?php

namespace App\Modules\Admin\LeadComment\Policies;

use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadCommentPolicy{
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

        return $user->userPermissionSet(['Root_Admin', 'LEADS_COMMENT_ACCESS', 'DASHBOARD_ACCESS']);

    }

    public function create(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_COMMENT_ACCESS']);

    }

    public function edit(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_COMMENT_ACCESS']);

    }

    public function delete(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_COMMENT_ACCESS']);

    }
}
