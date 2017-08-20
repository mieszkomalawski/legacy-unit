<?php


namespace PHPUnitAlt\Tests;


use function Patchwork\always;
use function Patchwork\redefine;
use function Patchwork\restoreAll;
use PHPUnit\Framework\TestCase;
use PHPUnitAlt\Entity;
use PHPUnitAlt\LegacyClass;
use PHPUnitAlt\Repository;
use Prophecy\Prophecy\ObjectProphecy;

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

    /**
     * @test
     */
    public function shouldReturn1OnSucess()
    {
        $sut = new LegacyClass();

        $repo = $this->prophesize(Repository::class);
        $repo->getAll()->willReturn([
            new Entity('a'),
            new Entity('b')
        ]);

        redefine(\PHPUnitAlt\LegacyClass::class . '::getRepository', always($repo->reveal()));
        $result = $sut->process(['foo']);

        static::assertEquals(1, $result);
    }

    public function tearDown()
    {
        restoreAll();
    }
}