<?php

declare(strict_types=1);

namespace App\CarInsurance\Request;

use SimpleXMLElement;

class OutputXmlRequest implements OutputRequestInterface
{
    public function render(array $data): string
    {
        $xml = new SimpleXMLElement('<data/>');
        array_walk_recursive($data, function ($value, $key) use ($xml) {
            $xml->addChild($key, (string)$value);
        });
        return $xml->asXML();
    }
}
