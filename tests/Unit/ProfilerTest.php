<?php

namespace TestingLegacy\Tests;

use phpmock\phpunit\PHPMock;
use phpmock\spy\Spy;
use PHPUnit\Framework\TestCase;
use TestingLegacy\Profiler;

class ProfilerTest extends TestCase
{
    use PHPMock;

    /**
     * @test
     */
    public function shouldMeasureExecutionTime()
    {
        $time = $this->getFunctionMock((new \ReflectionClass(Profiler::class))->getNamespaceName(), 'microtime');
        $time->expects(static::at(0))->willReturn(1);
        $time->expects(static::at(1))->willReturn(2);

        $profiler = new Profiler();
        $result = $profiler->profile(function () {
            // sleep symuluje wykonania jakiegoś kodu, dla celów testowych
            sleep(1);
        });

        static::assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function shouldCallMethods()
    {
        $spy = new Spy((new \ReflectionClass(Profiler::class))->getNamespaceName(), 'microtime');
        $spy->enable();

        $profiler = new Profiler();

        $result = $profiler->profile(function () {
            sleep(1);
        });

        static::assertEquals(2, count($spy->getInvocations()));
    }
}