<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\Lead\Services\LeadService;
use App\Services\Response\ResponseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller{

    private $service;

    public function __construct(LeadService $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $this->authorize('view', Lead::class);

        $result = $this->service->getLeads();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $result
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
    public function store(LeadCreateRequest $request) {

        $this->authorize('create', Lead::class);

        $lead = $this->service->store($request, Auth::user());

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $lead
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Lead\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead) {

        $this->authorize('view', Lead::class);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $lead
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Lead\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Lead\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(LeadCreateRequest $request, Lead $lead) {

        $this->authorize('edit', Lead::class);

        $lead = $this->service->update($request, Auth::user(), $lead);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $lead
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Lead\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead) {
        //
    }

    public function archive(){

        $this->authorize('view', Lead::class);

        $lead = $this->service->archive();

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $lead
        ]);
    }

    public function checkExist(Request $request){

        $this->authorize('create', Lead::class);

        $lead = $this->service->checkExist($request);

        if($lead){
            return ResponseServices::sendJSONResponse(true, 200, [], [
                'item' => $lead,
                'exist' =>true
            ]);
        }

        return ResponseServices::success();

    }



    public function updateQuality(Request $request, Lead $lead){

        $this->authorize('edit', Lead::class);

        $lead = $this->service->updateQuality($request, $lead);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'item' => $lead
        ]);
    }


}
