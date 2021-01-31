<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_request_data_validated()
    {
        $response = $this->post(
            'admin/api/user',
            [
                'name' => '',
                'email' => '',
                'department_id' => ''
            ]
        );

        $response->assertSessionHasErrors(['name', 'email', 'department_id']);
        
        $response2 = $this->post(
            'admin/api/user',
            [
                'name' => '2b',
                'email' => 'noemail.',
                'password' => '123456'
            ]
        );

        $response2->assertSessionHasErrors(['name', 'email', 'password']);


    }
}
