<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Department;
use App\Models\User;
use Tests\TestCase;

class UserEnabledTest extends TestCase
{
    public function test_enabled_user_access_home()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => true
            ]);

        $response = $this->actingAs($user)->get('/admin/home');
        $response->assertStatus(200);
    }

    public function test_enabled_user_access_user_disabled()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => true
            ]);

        $response = $this->actingAs($user)->get('/user_disabled');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
