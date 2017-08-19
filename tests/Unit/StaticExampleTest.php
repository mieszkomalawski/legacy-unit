<?php


namespace PHPUnitAlt\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnitAlt\Entity;
use PHPUnitAlt\StaticExample;

class StaticExampleTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnEntityCount()
    {
        $mock = \Mockery::mock('alias:\PHPUnitAlt\DB');

        $mock->shouldReceive('getAll')->andReturn([
            new Entity('a'),
            new Entity('b'),
            new Entity('c')
        ]);

        $result = (new StaticExample())->foo();

        static::assertEquals(3, $result);
    }
}