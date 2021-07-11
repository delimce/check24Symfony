<?php

namespace App\Tests\CarInsurance;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CarInsurance\Request\OutputRequestInterface;
use App\CarInsurance\Request\OutputXmlRequest;
use App\Tests\Objects\CarInsuranceData as mockData;

class OutputRequestTest extends KernelTestCase
{
    private OutputRequestInterface $outputRequest;

    use mockData;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->outputRequest = new OutputXmlRequest();
    }

    public function testXmlRenderMethod()
    {
        $data = $this->getData();
        $xml = $this->outputRequest->render($data);
        $this->assertStringStartsWith('<?xml version="1.0"?>', $xml);
    }
}
