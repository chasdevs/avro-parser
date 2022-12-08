<?php

use AvroParser\AvroMap;
use AvroParser\AvroType;
use AvroParser\AvroUnion;
use PHPUnit\Framework\TestCase;

final class DecodeTest extends TestCase
{
    public function testDecodeNullUnion(): void
    {
        $union = new AvroUnion([AvroType::NULL(), new AvroMap(AvroType::STRING())]);
        $result = $union->decode(null);
        $this->assertNull($result);
    }

    public function testDecodeMap(): void
    {
        $map = new AvroMap(AvroType::STRING());
        $result = $map->decode(['hey' => 'yo']);
        $this->assertEquals(['hey' => 'yo'], $result);
    }
}
