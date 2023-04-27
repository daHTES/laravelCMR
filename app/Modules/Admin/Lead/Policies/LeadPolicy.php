<?php

namespace App\Modules\Admin\Lead\Policies;

use App\Modules\Admin\Analitics\Policies\AnaliticsPolicy;
use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization, AnaliticsPolicy;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_ACCESS', 'DASHBOARD_ACCESS']);

    }

    public function create(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_CREATE']);

    }

    public function edit(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_EDIT']);

    }

    public function delete(User $user){

        return $user->userPermissionSet(['Root_Admin', 'LEADS_EDIT']);

    }
}
