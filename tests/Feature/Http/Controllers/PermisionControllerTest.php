<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermisionControllerTest extends TestCase
{
    use WithoutMiddleware;
 
    public function test_request_data_validated()
    {
        $response = $this->post('admin/api/permission', ['user_id' => '', 'permission_id' => '']);
        
        $response->assertSessionHasErrors(['user_id', 'permission_id']);
    }
}
