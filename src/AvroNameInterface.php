<?php

namespace AvroParser;

interface AvroNameInterface
{
    public function getCompilePath(): string;
    public function getQualifiedPhpType(): string;
}