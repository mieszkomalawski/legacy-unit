<?php


namespace TestingLegacy\Tests;

use function Patchwork\redefine;
use function Patchwork\restoreAll;
use PHPUnit\Framework\TestCase;
use TestingLegacy\LegacyClass;

class LegacyClassTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnEarly()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('I died');

        $sut = new LegacyClass();

        redefine('die', function () {
            throw new \Exception('I died');
        });

        $result = $sut->process([]);
    }


    public function tearDown()
    {
        restoreAll();
    }
}