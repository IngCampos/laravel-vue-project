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
 
    public function index()
    {
        return response()->json($this->alert->paginate());
        // status 200 is by default
        // return dd($this->alert->paginate());
    }

    public function store(AlertRequest $request)
    {
        $post = $this->alert->create($request->all());
        return response()->json($post, 201);
    }

    public function show(Alert $alert)
    {
        return response()->json($alert);
    }

    public function update(AlertRequest $request, Alert $alert)
    {
        $alert->update($request->all());

        return response()->json($alert);
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();

        return response()->json(null, 204);
    }
}
