<?php

namespace App\Modules\Admin\Task\Controllers\Api;

use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Services\TaskService;
use App\Services\Response\ResponseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller{

    private $service;

    public function __construct(TaskService $service){

        $this->service = $service;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $this->authorize('view', Task::class);

        $result = $this->service->getTasks();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $result
        ]);
        //
    }

    public function archive(){

        $this->authorize('view', Task::class);

        $tasks = $this->service->archive();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->authorize('view', Task::class);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $this->service->store($request, Auth::user())
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Task\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {


        $this->authorize('view', Task::class);
        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $task
        ]);
    }

}
