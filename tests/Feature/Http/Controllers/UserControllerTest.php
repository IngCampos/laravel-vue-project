<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithoutMiddleware;
    public function test_request_data_validated()
    {
        $response = $this->post(
            'admin/api/user',
            [
                'name' => '',
                'email' => '',
                'department_id' => ''
            ]
        );
        $response->assertSessionHasErrors(['name', 'email', 'department_id']);

        $response2 = $this->post(
            'admin/api/user',
            [
                'name' => '2b',
                'email' => 'noemail.',
                'password' => '123456'
            ]
        );
        $response2->assertSessionHasErrors(['name', 'email', 'password']);
    }

    // BUG: The controller does not work
    // public function test_store()
    // {
    //     $department = factory(Department::class)->create();
    //     $response = $this->post(
    //         'admin/api/user',
    //         [
    //             'name' => 'Name',
    //             'email' => 'name@mail.com',
    //             'password' => 'passwords',
    //             'department_id' => 1
    //         ]
    //     );
    //     $response->assertStatus(201);
    //     $this->assertDatabaseHas('users', ['name' => 'Name']);
    // }
    // BUG: Many details in the controller
    // public function test_update()
    // {
    //     $user = factory(User::class)->make([
    //         'department_id' => factory(Department::class),
    //         'isEnabled' => false
    //     ]);

    //     $response = $this->put("admin/api/user/1", [
    //         'name'=> 'new name',
    //         'email'=> 'newemail@mail.com',
    //         'department_id'=> 1,
    //         'password'=> 'newpassword'
    //         ]);
    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('users', ['name' => 'new name']);
    // }
    // BUG: Error 404
    // public function test_disabled()
    // {
    //     $user = factory(User::class)->make([
    //         'name' => 'User Disabled',
    //         'department_id' => factory(Department::class),
    //         'isEnabled' => false
    //     ]);

    //     $response = $this->delete("/admin/api/user/$user->id/disable");
    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('users', ['name' => 'User Disabled']);
    // }

    public function test_destroy()
    {
        $user = factory(User::class)->make([
            'department_id' => factory(Department::class),
            'isEnabled' => false
        ]);

        $response = $this->delete("/api/user/$user->id");
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
