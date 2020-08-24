<?php

use AvroParser\AvroMap;
use AvroParser\AvroType;
use AvroParser\AvroUnion;
use PHPUnit\Framework\TestCase;

final class TestAvroUnion extends TestCase
{
    public function testDecodeNull(): void
    {
        $union = new AvroUnion([AvroType::NULL(), new AvroMap(AvroType::STRING())]);
        $result = $union->decode(null);
        $this->assertNull($result);
    }
}
