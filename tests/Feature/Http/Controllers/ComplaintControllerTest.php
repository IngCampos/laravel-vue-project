<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Complaint;
use App\Models\Complaint_type;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ComplaintControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_request_data_validated()
    {
        $response = $this->post(
            '/contact',
            [
                'name' => '',
                'email' => '',
                'complaint_type_id' => '',
                'content' => ''
            ]
        );

        $response->assertSessionHasErrors(['name', 'email', 'complaint_type_id', 'content']);
    }

    public function test_store()
    {
        $data = [
            'name' => 'Anonymous User',
            'email' => 'anonymous@mail.com',
            'complaint_type_id' => '1',
            'content' => 'complaint about the website'
        ];

        $response = $this->post('/contact', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/contact');

        $this->assertDatabaseHas('complaints', ['name' => 'Anonymous User']);

    }
    
    public function test_destroy()
    {
        $complaint = factory(Complaint::class)->make([
            'complaint_type_id' => Complaint_type::create(['name' => 'Name'])
            ]);

        $response = $this->delete("/api/complaints/$complaint->id");
        $this->assertDatabaseMissing('complaints', ['id' => $complaint->id]);
    }
}
