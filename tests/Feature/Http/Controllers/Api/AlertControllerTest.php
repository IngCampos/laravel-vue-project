<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Department;
use App\User;
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
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);

        $response = $this->actingAs($user, 'api')->json('POST', '/api/alerts', [
            'title' => 'Alert test'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'Alert test'])
            ->assertStatus(201); // resource created!!

        $this->assertDatabaseHas('alerts', ['title' => 'Alert test']);
    }

    public function test_validate_title()
    {
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);

        $response = $this->actingAs($user, 'api')->json('POST', '/api/alerts', [
            'title' => 'Alert test'
        ]);

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => 'Alert test'])
            ->assertStatus(201); // resource created!!

        $this->assertDatabaseHas('alerts', ['title' => 'Alert test']);
    }

    public function test_show()
    {
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);
        $alert = factory(Alert::class)->create();

        $response = $this->actingAs($user, 'api')->json('GET', "/api/alerts/$alert->id"); // id = 1

        $response->assertJsonStructure(['id', 'title', 'created_at', 'updated_at'])
            ->assertJson(['title' => $alert->title])
            ->assertStatus(200); // Ok!!
    }

    public function test_404_show()
    {
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);

        $response = $this->actingAs($user, 'api')->json('GET', '/api/alerts/100000');

        $response->assertStatus(404);
    }

    public function test_update()
    {
        // $this->withoutExceptionHandling();
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);
        $alert = factory(Alert::class)->create();

        $response = $this->actingAs($user, 'api')->json('PUT', "/api/alerts/$alert->id", [
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
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);
        $alert = factory(Alert::class)->create();

        $response = $this->actingAs($user, 'api')->json('DELETE', "/api/alerts/$alert->id");

        $response->assertSee(null)->assertStatus(204); // There is not content!!

        $this->assertDatabaseMissing('alerts', ['id' => $alert->id]);
    }

    public function test_index()
    {
        $user = factory(User::class)->make(['department_id' => factory(Department::class)]);
        $alerts = factory(Alert::class, 5)->create();

        $response = $this->actingAs($user, 'api')->json('GET', "/api/alerts");

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'created_at', 'updated_at']
            ]
        ])->assertStatus(200);
    }

    public function test_guest()
    {
        $this->json('GET', '/api/alerts')->assertStatus(401);
        $this->json('POST', '/api/alerts')->assertStatus(401);
        $this->json('GET', '/api/alerts/1000')->assertStatus(401);
        $this->json('PUT', '/api/alerts/1000')->assertStatus(401);
        $this->json('DELETE', '/api/alerts/1000')->assertStatus(401);
    }
}
