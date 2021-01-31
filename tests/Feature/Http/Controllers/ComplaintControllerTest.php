<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComplaintControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_request_data_validated()
    {
        // TODO: create the features to create complaints
        // $response = $this->post(
        //     'admin/api/complaint',
        //     [
        //         'name' => '',
        //         'email' => '',
        //         'complaint_type_id' => '',
        //         'content' => ''
        //     ]
        // );

        // $response->assertSessionHasErrors(['name', 'email', 'complaint_type_id', 'content']);
    }
}
