<?php

namespace App\Modules\Admin\Users\Controllers\Api;

use App\Modules\Admin\Role\Services\RoleService;
use App\Modules\Admin\Users\Requests\UserRequest;
use App\Modules\Admin\Users\Services\UserService;
use App\Modules\Admin\Users\Models\User;

use App\Services\Response\ResponseServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $service;

    public function __construct(UserService $userService){

        $this->service = $userService;

    }

    public function index(){

        $this->authorize('view', new User());

        $users = $this->service->getUsers();

        return ResponseServices::sendJSONResponse(true, 200, [], [
           'users' => $users->toArray()
        ]);

    }

    /**
     * Create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {

        $user = $this->service->save($request, new User());

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'user' => $user->toArray()
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Users\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user) {

        $user = $this->service->save($request, $user);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'user' => $user->toArray()
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

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'user' => $user->toArray()
        ]);
    }

    public function usersForm(){

        $this->authorize('view', new User());

        $users = $this->service->getUsers();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'users' => $users->toArray()
        ]);
    }
}
