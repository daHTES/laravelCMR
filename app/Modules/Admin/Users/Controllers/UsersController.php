<?php

namespace App\Modules\Admin\Users\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Users\Models\Filters\UserSearch;
use App\Modules\Admin\Users\Models\User;
use App\Modules\Admin\Users\Requests\UserRequestWeb;
use App\Modules\Admin\Users\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Base{

    protected $service;

    public function __construct(UserService $service){

        parent::__construct();
        $this->service = $service;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserSearch $userSearch){

        $search = $request->input('search');
        $roleId = $request->input('role');

        $users = $userSearch->apply($request)->paginate(config('settings.pagination'))->appends(request()->input());

        $this->title = __("Users page");

        $this->content = view('Admin::Users.index')
            ->with([
                'items' => $users,
                'title' => $this->title,
                'roles' => Role::all(),
                'search' => $search,
                'roleId' => $roleId,
            ])->render();

        return $this->renderOutput();

    }

    /**
     * Create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        $this->title = __("Users Create");

        $roles = Role::all();

        $this->content = view('Admin::Users.create')
            ->with([
                'title' => $this->title,
                'roles' => $roles
            ])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequestWeb $request) {


        $this->service->saveWeb($request, new User());
        return \Redirect::route('users.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {

        $this->authorize('edit', $user);

        $this->title = "Users Edit";

        $this->content = view('Admin::Users.edit')->
        with([
            'title' => $this->title,
            'item' => $user,
            'roles' => Role::all()
        ])->
        render();

        return $this->renderOutput();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequestWeb $request, User $user) {

        $this->service->saveWeb($request, $user);
        return  \Redirect::route('users.index')->with([
            'message' => __('Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {

        $user->status = '0';
        $user->update();

        return  \Redirect::route('users.index')->with([
            'message' => __('Success')
        ]);
    }
}
