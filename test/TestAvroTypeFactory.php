<?php

use AvroParser\AvroRecord;
use AvroParser\AvroType;
use AvroParser\AvroTypeFactory;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNull;

final class TestAvroTypeFactory extends TestCase
{

    private const AVSC = <<<AVSC
{
    "type" : "record",
    "name" : "RecordWithEnum",
    "namespace" : "hyperspace",
    "fields" : [ {
        "name" : "favoriteFlavor",
        "type" : {
        "type" : "enum",
        "name" : "Flavor",
        "namespace" : "records.nested",
        "symbols" : [ "VANILLA", "CHOCOLATE", "STRAWBERRY" ]
        }
    }, {
        "name" : "favoriteFlavor2",
        "type" : "records.nested.Flavor"
    }, {
        "name" : "nullableFlavor",
        "type" : [ "null", "records.nested.Flavor" ]
    }, {
        "name" : "defaultFlavor",
        "type" : "records.nested.Flavor",
        "default" : "VANILLA"
    }]
}
AVSC;

    public function testX(): void
    {
        $avsc = json_decode(self::AVSC);

        /** @var AvroRecord $record */
        $record = AvroTypeFactory::create($avsc, "asdf");
        $this->assertNotNull($record);
        $this->assertEquals(['Hyperspace\RecordWithEnum'], $record->getImports());
        $this->assertEquals(AvroType::RECORD(), $record->getType());
        $this->assertEquals('RecordWithEnum', $record->getPhpDocType());
        $this->assertEquals('RecordWithEnum', $record->getPhpType());

        $field = $record->fields[3];
        $this->assertEquals("defaultFlavor", $field->name);
        $this->assertEquals(AvroType::ENUM(), $field->type->getType());
        $this->assertEquals('"VANILLA"', $field->phpDefault);
    }
}
