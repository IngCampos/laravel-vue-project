<?php

namespace Tests\Feature\Http\Controllers;

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
}
