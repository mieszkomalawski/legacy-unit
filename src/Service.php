<?php


namespace PHPUnitAlt;


class Service
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * Service constructor.
     * @param Repository $repository
     * @param Validator $validator
     */
    public function __construct(Repository $repository, Validator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    public function handleRequest($data)
    {
        $entity = new Entity($data['name']);

        // some logic

        $this->repository->save($entity);
    }

    /**
     * @param array $data
     */
    public function handleMultiple(array $data)
    {
        $this->repository->startTransaction();
        foreach($data as $singleRow){
            $entity = new Entity($singleRow['name']);
            if(true === $this->validator->isValid($entity)){
                $this->repository->save($entity);
            }
        }
        $this->repository->commit();
    }
}