<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase 
{ 
    use WithoutMiddleware;
    
    public function test_view_200() 
    {
        $this
            ->get('/')
            ->assertStatus(200);
    }
}