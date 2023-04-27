<?php

namespace App\Modules\Admin\Analitics\Policies;

use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

trait AnaliticsPolicy{

    public function viewAnalitic(User $user){

        return $user->userPermissionSet(['Root_Admin', 'ANALITICS_ACCESS']);

    }


}
