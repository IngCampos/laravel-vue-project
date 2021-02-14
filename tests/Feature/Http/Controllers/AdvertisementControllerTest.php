<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AdvertisementControllerTest extends TestCase
{
    use WithoutMiddleware;
 
    public function test_request_data_validated()
    {
        $response = $this->post('admin/api/advertisement', ['link' => 'badlink']);
        
        $response->assertSessionHasErrors(['link']);
    }

    public function test_store()
    {
        $data = [
            'image_source' => 'image.jpg',
            'link' => 'https://fakerphp.github.io/'. rand(0,10000),
            'expiration' => '2021-01-01'
        ];

        $response = $this->post('admin/api/advertisement', $data);

        $this->assertDatabaseHas('advertisements', ['link' => $data['link']]);
    }

    public function test_update()
    {
        $add = factory(Advertisement::class)->create();

        $response = $this->put("admin/api/advertisement/$add->id", [
            'image_source' => '2050-01-01',
            'expiration' => '2050-01-01',
            'link' => 'https://fakerphp.github.io/'
        ]);

        // $response->assertStatus(200);

        $this->assertDatabaseHas('advertisements', [
            'id' => $add->id,
            'expiration' => '2050-01-01'
            ]);
    }
}
