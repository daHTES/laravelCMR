<?php

namespace App\Modules\Admin\Role\Policies;

use App\Modules\Admin\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){

    }

    public function view(){

        return true;

    }
}
