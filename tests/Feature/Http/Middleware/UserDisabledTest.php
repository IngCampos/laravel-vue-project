<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Department;
use App\Models\User;
use Tests\TestCase;

class UserDisabledTest extends TestCase
{
    public function test_disabled_user_access_home()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => false
            ]);

        $response = $this->actingAs($user)->get('/admin/home');
        $response->assertStatus(302);
        $response->assertRedirect('/user_disabled');
    }
}
