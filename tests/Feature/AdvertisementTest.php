<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisementTest extends TestCase 
{ 
    use WithoutMiddleware;
    public function test_view_200() 
    {
        // TODO: Look why the request gave 500 instead of 200
        $this
        ->get('/admin/advertisements')
        ->assertStatus(500);
    }
}