<?php

namespace Tests\Unit\Models;

use App\Models\Complaint;
use PHPUnit\Framework\TestCase;

class ComplaintTest extends TestCase
{
    public function test_set_content()
    {
        $complaint = new Complaint();
        $complaint->content = "est consequuntur tenetur delectus";
        
        $this->assertEquals("Est consequuntur tenetur delectus", $complaint->content);
    }
}
