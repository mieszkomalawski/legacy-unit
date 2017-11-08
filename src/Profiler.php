<?php


namespace TestingLegacy;


class Profiler
{
    /**
     * @param callable $callable
     * @return float
     */
    public function profile(callable $callable)
    {
        $start = microtime(true);

        $callable();

        return microtime(true) - $start;
    }
}