<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TenderTest extends TestCase 
{ 
    use WithoutMiddleware;
    
    public function test_view_200() 
    {
        $this
            ->get('/admin/tenders')
            ->assertStatus(500);
    }
}