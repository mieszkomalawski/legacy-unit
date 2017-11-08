<?php


namespace TestingLegacy;


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
        throw new \Exception('Could not connect to database');
    }

    public function getById(int $id): Entity
    {
        throw new \Exception('Could not connect to database');
    }

    public function startTransaction()
    {
        throw new \Exception('Could not connect to database');
    }

    public function getAll(): array
    {
        throw new \Exception('Could not connect to database');
    }

    public function commit()
    {
        throw new \Exception('Could not connect to database');
    }
}