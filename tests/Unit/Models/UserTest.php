<?php

namespace Tests\Unit\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_get_first_name()
    {
        $user = new User();
        $user->name = "Martín Campos";
        
        $this->assertEquals("Martín", $user->first_name);
    }
    
    public function test_set_name()
    {
        $user = new User();
        $user->name = "Martín Campos";
        
        $this->assertEquals("martín campos", $user->name);
    }
}
