<?php

namespace App\Http\Controllers\Api;

use App\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlertRequest;

class AlertController extends Controller
{

    protected $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AlertRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlertRequest $request)
    {
        $post = $this->alert->create($request->all());
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AlertRequest  $request
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function update(AlertRequest $request, Alert $alert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert)
    {
        //
    }
}
