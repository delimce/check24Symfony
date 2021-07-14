<?php

namespace App\Tests\CarInsurance;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CarInsurance\Mappings\FooMappingStrategy;
use App\Tests\Objects\CarInsuranceData as mockData;

class FooMappingStrategyTest extends KernelTestCase
{
    protected FooMappingStrategy $fooMapping;
    protected array $mandatoryMappingKeys;
    protected array $mockMappingData;

    use mockData;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->mockMappingData = $this->getData();
        $this->fooMapping = new FooMappingStrategy();
        $this->mandatoryMappingKeys = $this->getMappingKeys();
    }

    /**
     * @test
     */
    public function testHasAllMandatoryMappingKeys()
    {
        $result = $this->fooMapping->doMapping($this->mockMappingData);
        array_walk($this->mandatoryMappingKeys, function ($key) use ($result) {
            $this->assertArrayHasKey($key, $result);
        });
    }

    /**
     * @test
     */
    public function testIsHolder()
    {
        $holder = $this->fooMapping->isHolder($this->mockMappingData);
        $result = in_array($holder, ["YES", "NO"]);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function testIsUniqueDriver()
    {
        $unique = $this->fooMapping->isUniqueDriver($this->mockMappingData);
        $result = in_array($unique, ["YES", "NO"]);
        $this->assertTrue($result);
    }

    public function testTotalAdditionalDrivers()
    {
        $total = $this->fooMapping->getTotalAdditionalDrivers($this->mockMappingData);
        $this->assertIsInt($total);
    }

    /**
     * @test
     */
    public function testIsAlreadyInsuredDriver()
    {
        $isInsuredDriver = $this->fooMapping->isAlreadyInsuredDriver($this->mockMappingData);
        $result = in_array($isInsuredDriver, ["YES", "NO"]);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function testGetInsuranceSeniority()
    {
        $total = $this->fooMapping->getInsuranceSeniority($this->mockMappingData);
        $this->assertIsInt($total);
    }
}
