<?php

namespace Tests\Unit;

use App\Models\Tender_section;
use PHPUnit\Framework\TestCase;

class TenderSectionTest extends TestCase
{
    public function test_get_name()
    {
        $tender_section = new Tender_section();
        $tender_section->isInternational = true;
        $tender_section->number = 1;
        $tender_section->year = 2020;
        
        $this->assertEquals("Public tender International 001-2020", $tender_section->get_name);
    }
}
