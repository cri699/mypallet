<?php

namespace Tests\Unit\TransportUnit;

use App\Enums\TransportType;
use App\Models\TransportUnit;
use Tests\TestCase;

class TransportUnitTest extends TestCase
{
    public function test_type_accessor_and_mutator()
    {
        $transportUnit = new TransportUnit();
        $transportUnit->type = TransportType::TRUCK;

        // Check that the type is stored as a string value (like 'truck')
        $this->assertEquals('truck', $transportUnit->getAttributes()['type']);

        // Simulate retrieving the type attribute
        $retrievedType = $transportUnit->type;
        $this->assertInstanceOf(TransportType::class, $retrievedType);
        $this->assertEquals(TransportType::TRUCK, $retrievedType);
    }

}
