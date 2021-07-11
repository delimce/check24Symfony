<?php

namespace App\Tests\CarInsurance;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CarInsurance\Reader\InputJsonReader;

class InputReaderTest extends KernelTestCase
{

    const FILENAME = "input1.json";
    protected InputJsonReader $reader;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->reader = new InputJsonReader(self::FILENAME);
    }

    /**
     * @test
     */
    public function testJsonReaderClassExist()
    {
        $this->assertInstanceOf(InputJsonReader::class, $this->reader);
    }

    /**
     * @test
     */
    public function testJsonContentReadSuccessfully()
    {
        $this->assertTrue(count($this->reader->getObject()) > 0);
    }

    /**
     * @test
     */
    public function testReadObjectHasKeyToMapping()
    {
        $this->assertArrayHasKey("occasional_driver", $this->reader->getObject());
        $this->assertArrayHasKey("prevInsurance", $this->reader->getObject());
    }

}
