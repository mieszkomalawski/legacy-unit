<?php


namespace PHPUnitAlt;


class DumbProfiler
{
    /**
     * @param callable $callable
     * @return int
     */
    public function profile(callable $callable) : float
    {
        $start = microtime(true);

        $callable();

        $duration = microtime(true) - $start;

        return $duration;
    }
}