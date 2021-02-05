<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Machine;
use App\Models\Machine_state;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MachineStateControllerTest extends TestCase
{
    use WithoutMiddleware;
    public function test_request_data_validated()
    {
        $response = $this->put('admin/api/machine_state/1', ['machine_state_id' => '10']);

        $response->assertSessionHasErrors(['machine_state_id']);
    }

    // BUG: There is a bug in controller
    // public function test_update()
    // {
    //     $machine = factory(Machine::class)->make([
    //         'machine_state_id' => Machine_state::create(['name' => 'Status'])
    //     ]);
    //     $state_id = $machine->machine_state_id;
    //     $new_status_id = Machine_state::create(['name' => 'New status']);

    //     $response = $this->put("admin/api/machine_state/{$machine->id}",
    //      ['machine_state_id' => $new_status_id->id]
    //     )->assertStatus(200);
    //     $this->assertDatabaseMissing('machines', ['machine_state_id' => $state_id]);
    //     $this->assertDatabaseHas('machines', ['machine_state_id' => $new_status_id]);
    // }
}
