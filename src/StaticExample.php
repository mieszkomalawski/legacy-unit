<?php


namespace TestingLegacy;


class StaticExample
{
    /**
     * @return int
     */
    public function foo()
    {
        $entities = DB::getAll();

        // do some logic that we need to test

        //
        return count($entities);
    }
}