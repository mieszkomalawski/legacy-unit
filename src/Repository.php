<?php


namespace PHPUnitAlt;


class Repository
{

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        throw new \Exception('Could not connect to database');
    }

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

    public function getAll() : array
    {
        return [];
    }

    public function commit(){

    }
}