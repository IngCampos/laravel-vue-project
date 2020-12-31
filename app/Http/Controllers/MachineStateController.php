<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Http\Requests\MachineRequest;

class MachineStateController extends Controller
{
    public function index()
    {
        $machines = Machine::orderBy('user_agent', 'asc')->paginate(10);
        return [
            'pagination' => [
                'total' => $machines->total(),
                'current_page' => $machines->currentPage(),
                'per_page' => $machines->perPage(),
                'last_page' => $machines->lastPage(),
                'from' => $machines->firstItem(),
                'to' => $machines->lastItem(),
            ],
            'machines' => $machines->load('machine_state')
        ];
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
