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


    public function create(array $data)
    {
        $entity = new Entity($data['name']);

        if($this->validator->isValid($entity)){
            $id = $this->repository->save($entity);

            return $this->repository->getById($id);
        }

    }

    /**
     * @param array $data
     */
    public function createMultiple(array $data)
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