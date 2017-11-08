<?php


namespace TestingLegacy\Tests;

use PHPUnit\Framework\TestCase;
use TestingLegacy\Entity;
use TestingLegacy\StaticExample;

class StaticExampleTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnEntityCount()
    {
        $mock = \Mockery::mock('alias:\TestingLegacy\DB');

        $mock->shouldReceive('getAll')->andReturn([
            new Entity('a'),
            new Entity('b'),
            new Entity('c')
        ]);

        $result = (new StaticExample())->foo();

        static::assertEquals(3, $result);
    }
}