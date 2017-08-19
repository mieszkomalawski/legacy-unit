<?php


namespace PHPUnitAlt\Tests;


use phpmock\MockBuilder;
use phpmock\phpunit\PHPMock;
use phpmock\spy\Spy;
use PHPUnit\Framework\TestCase;
use PHPUnitAlt\DumbProfiler;

class DumbProfilerTest extends TestCase
{
    use PHPMock;

    /**
     * @test
     */
    public function shouldCheck()
    {
        $time = $this->getFunctionMock('PHPUnitAlt', 'microtime');
        $time->expects(static::at(0))->willReturn(1);
        $time->expects(static::at(1))->willReturn(2);

        $profiler = new DumbProfiler();

        $result = $profiler->profile(function(){
            sleep(1);
        });

        static::assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function shouldCallMethods()
    {
        $spy = new Spy('PHPUnitAlt', 'microtime');
        $spy->enable();

        $profiler = new DumbProfiler();

        $result = $profiler->profile(function(){
            sleep(1);
        });

        static::assertEquals(2, count($spy->getInvocations()));
    }
}