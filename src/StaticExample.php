<?php


namespace PHPUnitAlt;


class StaticExample
{
    /**
     * @return int
     */
    public function foo()
    {
        $entities = DB::getAll();

        // do some logic

        //
        return count($entities);
    }
}