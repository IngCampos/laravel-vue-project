<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class helpersTest extends TestCase
{
    public function test_format_date()
    {
        $date = "2020-04-28 13:50:22";
        $date_formatted = FormatDate($date);
        $this->assertEquals('13:50 28/04/20', $date_formatted);
    }
}
