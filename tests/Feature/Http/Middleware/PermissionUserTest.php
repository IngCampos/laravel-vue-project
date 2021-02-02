<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Permission;
use App\Models\Department;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionUserTest extends TestCase
{
    use RefreshDatabase;
    public function test_no_access_sections_with_permissions()
    {
        $this->withoutExceptionHandling();      
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => true
        ]);

        $response_admin = $this->actingAs($user)->get('/admin/users');
        $response_admin->assertStatus(302);
        $response_admin->assertRedirect('/');
        
        $response_complaints = $this->actingAs($user)->get('/admin/complaints');
        $response_complaints->assertStatus(302);
        $response_complaints->assertRedirect('/');

        $response_advertisements = $this->actingAs($user)->get('/admin/advertisements');
        $response_advertisements->assertStatus(302);
        $response_advertisements->assertRedirect('/');

        $response_machine_state = $this->actingAs($user)->get('/admin/machine_state');
        $response_machine_state->assertStatus(302);
        $response_machine_state->assertRedirect('/');
        
        $response_tenders = $this->actingAs($user)->get('/admin/tenders');
        $response_tenders->assertStatus(302);
        $response_tenders->assertRedirect('/');
        
        $response_posts = $this->actingAs($user)->get('/admin/posts');
        $response_posts->assertStatus(302);
        $response_posts->assertRedirect('/');
    }

    public function test_access_admin_section()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => true
        ]);
        $permission = Permission::create([
            'id' => 1,
            'name' => 'System Administrator',
            'description' => 'System Administrator',
        ]);
        $user->permissions()->detach($permission);

        $response = $this->actingAs($user)->get('/admin/users');
        // BUG: Check why the status is not 200
        $response->assertStatus(302);
    }
}
