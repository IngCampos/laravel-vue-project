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
        // TODO: create the features to create complaints
        $response = $this->post(
            'admin/api/complaint',
            [
                'name' => '',
                'email' => '',
                'complaint_type_id' => '',
                'content' => ''
            ]
        );

        $response->assertSessionHasErrors(['name', 'email', 'complaint_type_id', 'content']);
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
