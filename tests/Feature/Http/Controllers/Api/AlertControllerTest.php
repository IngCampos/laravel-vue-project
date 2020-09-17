<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlertControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', '/alerts', [
            'title' => 'Alert test'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'Alert test'])
            ->assertStatus(201); // resource created!!

        $this->assertDatabaseHas('alerts', ['title' => 'Alert test']);
    }

    public function test_validate_title()
    {
        $response = $this->json('POST', '/alerts', [
            'title' => ''
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('title'); // Error!!
    }
}
