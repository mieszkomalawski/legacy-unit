<?php


namespace TestingLegacy;


class LegacyClass
{
    /**
     * @param array $data
     * @return int
     */
    public function process(array $data)
    {
        if (empty($data)) {
            die();
        }

        $repository = new Repository();

        $entities = $repository->getAll();
        if (empty($entities)) {
            echo 'error';
        }

        // do some logic
        return 1;
    }


}