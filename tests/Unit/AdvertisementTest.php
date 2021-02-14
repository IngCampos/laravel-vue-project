<?php

namespace Tests\Unit;

use App\Models\Advertisement;
use PHPUnit\Framework\TestCase;

class AdvertisementTest extends TestCase
{
    public function test_set_image_source()
    {
        $user = new Advertisement();
        $user->image_source = "image.jpg";
        
        $this->assertEquals("/storage/ads/image.jpg", $user->image_source);
    }
}
