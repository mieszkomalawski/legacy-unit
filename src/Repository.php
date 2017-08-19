<?php


namespace PHPUnitAlt;


class Repository
{
    public function save(Entity $entity)
    {
        return 1;
    }

    public function getById(int $id) : Entity
    {

    }

    public function startTransaction()
    {
        
    }

    public function commit(){

    }
}