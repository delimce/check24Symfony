<?php


namespace App\Tests\CarInsurance;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CarInsurance\Service\GenerateRequestService;
use App\CarInsurance\Reader\InputJsonReader;
use App\CarInsurance\Mappings\AbstractMappingStrategy;
use App\CarInsurance\Request\OutputRequestInterface;

class GenerateRequestServiceTest extends KernelTestCase
{
    protected GenerateRequestService $requestService;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->requestService = new GenerateRequestService();
        $this->requestService->setConfiguration('input1.json');
    }

    /**
     * @test
     */
    public function testGenerateRequestClassExist()
    {
        $this->assertInstanceOf(GenerateRequestService::class, $this->requestService);
    }

    /**
     * @test
     */
    public function testSetConfigurationService()
    {
        $this->assertInstanceOf(InputJsonReader::class, $this->requestService->getReader());
        $this->assertInstanceOf(AbstractMappingStrategy::class, $this->requestService->getMappingStrategy());
        $this->assertInstanceOf(OutputRequestInterface::class, $this->requestService->getOutput());
    }

    /**
     * @test
     */
    public function testGetMappedValuesMethod()
    {
        $this->assertIsArray($this->requestService->getMappedValues());
    }

    /**
     * @test
     */
    public function testGenerateRequestMethod()
    {
        $mappedData = $this->requestService->getMappedValues();
        $result = $this->requestService->generateRequest($mappedData);
        $this->assertIsString($result);
    }
}
