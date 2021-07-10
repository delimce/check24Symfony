<?php

declare(strict_types=1);

namespace App\CarInsurance\Service;

use App\CarInsurance\Mappings\AbstractMappingStrategy;
use App\CarInsurance\Request\OutputRequestInterface;
use App\CarInsurance\Reader\InputReaderInterface;

use App\CarInsurance\Mappings\FooMappingStrategy;
use App\CarInsurance\Request\OutputXmlRequest;
use App\CarInsurance\Reader\InputJsonReader;

class GenerateRequestService
{
    private AbstractMappingStrategy $mappingStrategy;
    private InputReaderInterface $reader;
    private OutputRequestInterface $output;

    public function getMappedValues(): array
    {
        $originalData = $this->reader->getObject();
        return $this->mappingStrategy->doMapping($originalData);
    }

    public function generateRequest(array $data): string
    {
        return $this->output->render($data);
    }

    public function setConfiguration(
        string $filename,
        AbstractMappingStrategy $strategy = null,
        OutputRequestInterface $output = null
    ) {
        $this->reader = new InputJsonReader($filename);
        $this->mappingStrategy = $strategy ?? new FooMappingStrategy(); # default mapping
        $this->output = $output ?? new OutputXmlRequest();
    }

    public function getMappingStrategy(): AbstractMappingStrategy
    {
        return $this->mappingStrategy;
    }


    public function getReader(): InputJsonReader
    {
        return $this->reader;
    }


    public function getOutput(): OutputRequestInterface
    {
        return $this->output;
    }
}
