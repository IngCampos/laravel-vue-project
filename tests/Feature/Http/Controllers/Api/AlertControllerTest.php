<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Alert;

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

    public function test_show()
    {
        $alert = factory(Alert::class)->create();

        $response = $this->json('GET', "/alerts/$alert->id"); // id = 1

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => $alert->title])
            ->assertStatus(200); // Ok!!
    }

    public function test_404_show()
    {
        $response = $this->json('GET', '/alerts/100000');

        $response->assertStatus(404);
    }

    public function test_update()
    {
        // $this->withoutExceptionHandling();
        $alert = factory(Alert::class)->create();

        $response = $this->json('PUT', "/alerts/$alert->id", [
            'title' => 'New title'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'New title'])
            ->assertStatus(200); // resource updated!!

        $this->assertDatabaseHas('alerts', ['title' => 'New title']);
    }

    public function test_delete()
    {
        // $this->withoutExceptionHandling();
        $alert = factory(Alert::class)->create();

        $response = $this->json('DELETE', "/alerts/$alert->id");

        $response->assertSee(null)->assertStatus(204); // There is not content!!

        $this->assertDatabaseMissing('alerts', ['id' => $alert->id]);
    }

    public function test_index()
    {
        $alerts = factory(Alert::class, 5)->create();

        $response = $this->json('GET', "/alerts");

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'created_at', 'updated_at']
            ]
        ])->assertStatus(200);
    }
}
