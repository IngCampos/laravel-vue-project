<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Department;
use App\Models\User;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function test_no_access_guest_home()
    {
        $response = $this->get('/admin/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_access_user_home()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => true
            ]);

        $response = $this->actingAs($user)->get('/admin/home');
        $response->assertStatus(200);
    }
}
