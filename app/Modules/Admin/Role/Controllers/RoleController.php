<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Base {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $this->authorize('view', Role::class);

        $roles = Role::all();

        $this->title = "Title Role Index";

        $this->content = view('Admin::Role.index')->
        with([
            'roles' => $roles,
            'title' => $this->title,
        ])->

        render();

        return $this->renderOutput();

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
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {
        //
    }
}
