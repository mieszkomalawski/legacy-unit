<?php


describe("Create multiple", function () {

    given('repository', function(){
        return \Kahlan\Plugin\Double::instance(['class' => \PHPUnitAlt\Repository::class]);
    });

    given('validator', function(){
        return \Kahlan\Plugin\Double::instance(['class' => \PHPUnitAlt\Validator::class]);
    });

    it('Saves only valid entities', function () {

        $validator = $this->validator;
        $repository = $this->repository;

        allow($validator)->toReceive('isValid')->with(\Kahlan\Arg::toEqual(new \PHPUnitAlt\Entity('valid_name')))->andReturn(true);
        allow($validator)->toReceive('isValid')->with(\Kahlan\Arg::toEqual(new \PHPUnitAlt\Entity('invalid_name')))->andReturn(false);
        allow($validator)->toReceive('isValid')->with(\Kahlan\Arg::toEqual(new \PHPUnitAlt\Entity('valid_name2')))->andReturn(true);

        expect($repository)->toReceive('startTransaction');
        expect($repository)->toReceive('save')->with(\Kahlan\Arg::toEqual(new \PHPUnitAlt\Entity('valid_name')));
        expect($repository)->toReceive('save')->with(\Kahlan\Arg::toEqual(new \PHPUnitAlt\Entity('valid_name2')));
        expect($repository)->toReceive('commit');

        $sut = new \PHPUnitAlt\Service($repository, $validator);

        $sut->createMultiple([
            ['name' => 'valid_name'],
            ['name' => 'invalid_name'],
            ['name' => 'valid_name2'],
        ]);
    });
});