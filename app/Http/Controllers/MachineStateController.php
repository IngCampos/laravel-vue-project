<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Http\Requests\MachineRequest;

class MachineStateController extends Controller
{
    public function index()
    {
        return Machine::orderBy('user_agent', 'asc')->get()->load('machine_state');
    }

    public function update(MachineRequest $request, $id)
    {
        // TODO: fix the bug here, Machine $machine as parameter does not work
        $machine = Machine::find($id);
        $machine->machine_state_id = $request->machine_state_id;
        $machine->update();
        $machine->machine_state;
        return $machine;
    }
}
