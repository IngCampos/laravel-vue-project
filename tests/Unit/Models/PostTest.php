<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    // BUG: Test does not work due to Sluggable
    // public function test_get_excerpt()
    // {
    //     $post = new Post();
    //     $post->body = "Est consequuntur tenetur delectus voluptatum distinctio quia sunt. Occaecati placeat sed quo et doloribus dolor occaecati porro. Vitae labor ed ut perspiciatis unde omnis";
        
    //     $this->assertEquals('Est consequuntur tenetur delectus voluptatum distinctio quia sunt. Occaecati placeat sed quo et doloribus dolor occaecati porro. Vitae labor...', $post->get_excerpt);
    // }

    // public function test_get_image()
    // {
    //     $post = new Post();
    //     $post->image = "file.jpg";
        
    //     $this->assertEquals('storage/file.jpg', $post->get_image);
    // } 
}
