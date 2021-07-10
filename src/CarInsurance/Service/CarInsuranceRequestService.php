<?php

declare( strict_types = 1 );

namespace App\CarInsurance\Service;

use App\CarInsurance\Mappings\AbstractMappingStrategy;
use App\CarInsurance\Request\OutputRequestInterface;
use App\CarInsurance\Reader\InputReaderInterface;

use App\CarInsurance\Mappings\FooMappingStrategy;
use App\CarInsurance\Request\OutputXmlRequest;
use App\CarInsurance\Reader\InputJsonReader;

class CarInsuranceRequestService
{
    private AbstractMappingStrategy $mappingStrategy;
    private InputReaderInterface $reader;
    private OutputRequestInterface $output;

    public function getMappedValues(): array
    {
        $originalData = $this->reader->getObject();
        return $this->mappingStrategy->doMapping($originalData);
    }

    public function generateRequest(array $data)
    {
        return $this->output->render($data);
    }

    public function setConfiguration(
        string $scenario,
        AbstractMappingStrategy $strategy = null,
        OutputRequestInterface $output = null
    ) {
        $this->reader = new InputJsonReader($scenario);
        $this->mappingStrategy = $strategy ?? new FooMappingStrategy(); # default mapping
        $this->output = $output ?? new OutputXmlRequest();
    }
}
