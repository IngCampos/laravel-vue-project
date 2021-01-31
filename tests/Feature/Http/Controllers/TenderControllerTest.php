<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenderControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_request_data_validated()
    {
        $response = $this->post(
            'admin/api/tender',
            [
                'internal_file' => 'abcd',
                'name' => 'ab',
                'tender_section_id' => 'abcd',
            ]
        );

        $response->assertSessionHasErrors(['internal_file', 'name', 'tender_section_id']);
    }
}
