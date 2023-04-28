<?php

namespace App\Modules\Admin\Sources\Controllers\Api;

use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Requests\TaskCommentRequest;
use App\Modules\Admin\Sources\Services\TaskService;
use App\Services\Response\ResponseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourcesController extends Controller
{
    private $service;

    public function __construct(TaskService $sourcesService){

        $this->service = $sourcesService;

    }

    public function index(){

        $this->authorize('view', new Source());

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $this->service->getSources()
        ]);
    }

    /**
     * Create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCommentRequest $request) {

        $item = $this->service->save($request, new Source());

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'item' => $item->toArray()
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source) {

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'item' => $source->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCommentRequest $request, Source $source) {

        $item = $this->service->save($request, $source);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'item' => $item->toArray()
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source) {

        $source->delete();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'item' => $source->toArray()
        ]);
    }
}
