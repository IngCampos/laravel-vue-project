<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Http\Requests\MachineRequest;

class MachineStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Machine::orderBy('user_agent', 'asc')->get()->load('machine_state');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MachineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MachineRequest $request, $id)
    {
        $machine = Machine::find($id);
        $machine->machine_state_id = $request->machine_state_id;
        $machine->update();
        $machine->machine_state;
        return $machine;
    }
}
