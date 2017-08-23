<?php


namespace PHPUnitAlt\Tests;


use PHPUnit\Framework\TestCase;
use PHPUnitAlt\Entity;
use PHPUnitAlt\Repository;
use PHPUnitAlt\Service;
use PHPUnitAlt\Validator;
use Prophecy\Argument;

class CreateTest extends TestCase
{
    /**
     * @test
     */
//    public function entityShouldBeSaved()
//    {
//        $repositoryMock = $this->getMockBuilder(Repository::class)->disableOriginalConstructor()->getMock();
//        $validatorMock = $this->getMockBuilder(Validator::class)->getMock();
//
//        $entity = new Entity('some_name');
//        $validatorMock->expects(static::any())->method('isValid')->with($entity)->willReturn(true);
//        $repositoryMock->expects(static::any())->method('save')->with($entity)->willReturn(1);
//
//        $repositoryMock->expects(static::any())->method('getById')->with(1)->willReturn($entity);
//
//        $sut = new Service(
//            $repositoryMock,
//            $validatorMock
//        );
//
//        $result = $sut->create(['name' => 'some_name']);
//
//        static::assertEquals($entity, $result);
//    }

    public function entityShouldBeSaved()
    {
        /** @var Repository $repositoryMock */
        $repositoryMock = $this->prophesize(Repository::class);
        /** @var Validator $validatorMock */
        $validatorMock = $this->prophesize(Validator::class);

        $entity = new Entity('some_name');
        $validatorMock->isValid($entity)->willReturn(true);
        $repositoryMock->save($entity)->will(function ($args) use ($repositoryMock) {
            $repositoryMock->getById(1)->willReturn($args[0]);
            return 1;
        });

        $sut = new Service(
            $repositoryMock->reveal(),
            $validatorMock->reveal()
        );

        $result = $sut->create(['name' => 'some_name']);

        static::assertEquals($entity, $result);
    }
}