<?php

declare( strict_types = 1 );

namespace App\CarInsurance\Reader;

interface InputReaderInterface
{
    public function load(string $rawContent);
    public function getObject(): array;
}
