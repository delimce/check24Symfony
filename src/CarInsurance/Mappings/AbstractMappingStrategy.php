<?php

declare( strict_types = 1 );

namespace App\CarInsurance\Mappings;

use DateTime;

abstract class AbstractMappingStrategy
{
    abstract function doMapping(array $originalData): array;


    /**
     * @return string
     */
    protected function getCurrentDateIso(): string
    {
        $datetime = new DateTime();
        return  $datetime->format(DateTime::ISO8601); // Updated ISO8601
    }

}
