<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithoutMiddleware;
 
    public function test_request_data_validated()
    {
        $response = $this->post('admin/posts', ['title' => '', 'body' => '']);
        
        $response->assertSessionHasErrors(['title', 'body']);
    }
}
