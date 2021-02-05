<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenderSectionControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_request_data_validated()
    {
        $response = $this->post(
            'admin/api/tender_section',
            [
                'isInternational' => '',
                'year' => ''
            ]
        );
        $response->assertSessionHasErrors(['isInternational', 'year']);
    
        $response2 = $this->post(
            'admin/api/tender_section',
            [
                'isInternational' => 'abcs',
                'year' => '20'
            ]
        );
        $response2->assertSessionHasErrors(['isInternational', 'year']);
    
    }
}
