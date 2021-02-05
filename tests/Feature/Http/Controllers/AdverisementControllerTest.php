<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdverisementControllerTest extends TestCase
{
    use WithoutMiddleware;
 
    public function test_request_data_validated()
    {
        $response = $this->post('admin/api/advertisement', ['order' => '20', 'link' => 'badlink']);
        
        $response->assertSessionHasErrors(['order', 'link']);
    }
}
