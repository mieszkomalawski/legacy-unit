<?php


namespace PHPUnitAlt;


class LegacyClass
{
    /**
     * @param array $data
     * @return int
     */
    public function process(array $data)
    {
        if(empty($data)){
            die();
        }

        $repository = new Repository();
        //$repository = $this->getRepository();

        $entities = $repository->getAll();
        if(empty($entities)){
            echo 'error';
        }

        // do some logic
        return 1;
    }

    /**
     * @return Repository
     */
    /*protected function getRepository(): Repository
    {
        return new Repository();
    }*/
}