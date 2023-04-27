<?php

namespace App\Modules\Admin\Analitics\Controllers\Api;

use App\Modules\Admin\Analitics\Models\Analitic;
use App\Modules\Admin\Analitics\Services\AnaliticDataService;
use App\Modules\Admin\Lead\Models\Lead;
use App\Services\Response\ResponseServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnaliticsController extends Controller{

    private $service;


    public function __construct(AnaliticDataService $service){

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){


        $this->authorize('viewAnalitic', Lead::class);

        $leadsData = $this->service->getAnalitic($request);

        return ResponseServices::sendJSONResponse(true, 200, [], [
            'items' => $leadsData
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
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Analitics\Models\Analitic  $analitic
     * @return \Illuminate\Http\Response
     */
    public function show(Analitic $analitic) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Analitics\Models\Analitic  $analitic
     * @return \Illuminate\Http\Response
     */
    public function edit(Analitic $analitic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Analitics\Models\Analitic  $analitic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analitic $analitic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Analitics\Models\Analitic  $analitic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analitic $analitic)
    {
        //
    }
}
