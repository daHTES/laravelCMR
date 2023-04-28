<?php


namespace App\Modules\Admin\Users\Models\Filters;


use App\Modules\Admin\Users\Models\User;
use App\Services\Filters\Searchable;
use App\Services\Filters\BaseSearch;

class UserSearch implements Searchable{

    const MODEL = User::class;
    use BaseSearch;

}
