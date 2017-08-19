<?php


namespace PHPUnitAlt\Tests;


use PHPUnit\Framework\TestCase;
use PHPUnitAlt\Entity;
use PHPUnitAlt\Repository;
use PHPUnitAlt\Service;
use PHPUnitAlt\Validator;
use Prophecy\Argument;
use Prophecy\Argument\Token\TypeToken;
use Prophecy\Prediction\CallTimesPrediction;

class ServiceTest extends TestCase
{
    /**
     * @test
     */
    /*public function shouldSaveMultiple()
    {
        $repositoryMock = $this->getMockBuilder(Repository::class)->getMock();

        $validatorMock = $this->getMockBuilder(Validator::class)->getMock();

        $validatorMock->expects(static::at(0))->method('isValid')->with(new Entity('some_valid_name'))->willReturn(true);
        $validatorMock->expects(static::at(1))->method('isValid')->with(new Entity('invalid_name'))->willReturn(false);
        $validatorMock->expects(static::at(2))->method('isValid')->with(new Entity('some_valid_name_2'))->willReturn(true);

        $data = [
            ['name' => 'some_valid_name'],
            ['name' => 'invalid_name'],
            ['name' => 'some_valid_name_2'],
        ];

        $sut = new Service(
            $repositoryMock,
            $validatorMock
        );

        $repositoryMock->expects(static::at(0))->method('save')->with(new Entity('some_valid_name'));
        $repositoryMock->expects(static::at(1))->method('save')->with(new Entity('some_valid_name_2'));

        $sut->handleMultiple($data);
    }*/

    /**
     * @test
     */
//    public function shouldSaveMultiple()
//    {
//        $repositoryMock = $this->getMockBuilder(Repository::class)->getMock();
//
//        $validatorMock = $this->getMockBuilder(Validator::class)->getMock();
//
//        /**
//         * nie zadziałą bo pod spodem jest porównanie === a to jest osobna instancja obiektu
//         */
//        $map = [
//            [new Entity('some_valid_name'), true],
//            [new Entity('invalid_name'), false],
//            [new Entity('some_valid_name_2'), true],
//        ];
//        $validatorMock->method('isValid')->will($this->returnValueMap($map));
//
//        $data = [
//            ['name' => 'some_valid_name'],
//            ['name' => 'invalid_name'],
//            ['name' => 'some_valid_name_2'],
//        ];
//
//        $sut = new Service(
//            $repositoryMock,
//            $validatorMock
//        );
//
//        $repositoryMock->expects(static::at(0))->method('save')->with(new Entity('some_valid_name'));
//        $repositoryMock->expects(static::at(1))->method('save')->with(new Entity('some_valid_name_2'));
//
//        $sut->handleMultiple($data);
//    }

//    /**
//     * @test
//     */
//    public function shouldSaveMultiple()
//    {
//        $repositoryMock = $this->getMockBuilder(Repository::class)->getMock();
//
//        $validatorMock = $this->getMockBuilder(Validator::class)->getMock();
//
//        /**
//         * nie zadziałą bo pod spodem jest porównanie === a to jest osobna instancja obiektu
//         */
//        $map = [
//            [new Entity('some_valid_name'), true],
//            [new Entity('invalid_name'), false],
//            [new Entity('some_valid_name_2'), true],
//        ];
//        $validatorMock->method('isValid')->willReturnCallback(function(){
//            $args = func_get_args();
//            /** @var Entity $entity */
//            $entity = $args[0];
//
//            if($entity->getName() == 'some_valid_name'){
//                return true;
//            }
//            if($entity->getName() == 'invalid_name'){
//                return false;
//            }
//            if($entity->getName() == 'some_valid_name_2'){
//                return true;
//            }
//        });
//
//        $data = [
//            ['name' => 'some_valid_name'],
//            ['name' => 'invalid_name'],
//            ['name' => 'some_valid_name_2'],
//        ];
//
//        $sut = new Service(
//            $repositoryMock,
//            $validatorMock
//        );
//
//        $repositoryMock->expects(static::at(1))->method('save')->with(new Entity('some_valid_name'));
//        $repositoryMock->expects(static::at(2))->method('save')->with(new Entity('some_valid_name_2'));
//
//        $sut->handleMultiple($data);
//    }

//    /**
//     * @test
//     */
//    public function shouldSaveMultiple()
//    {
//        /** @var Repository $repositoryMock */
//        $repositoryMock = $this->prophesize(Repository::class);
//
//        /** @var Validator $validatorMock */
//        $validatorMock = $this->prophesize(Validator::class);
//
//        $validatorMock->isValid(new Entity('some_valid_name'))->willReturn(true);
//        $validatorMock->isValid(new Entity('invalid_name'))->willReturn(false);
//        $validatorMock->isValid(new Entity('some_valid_name_2'))->willReturn(true);
//
//        $sut = new Service(
//            $repositoryMock->reveal(),
//            $validatorMock->reveal()
//        );
//
//        $data = [
//            ['name' => 'some_valid_name'],
//            ['name' => 'invalid_name'],
//            ['name' => 'some_valid_name_2'],
//        ];
//        $sut->handleMultiple($data);
//
//        $repositoryMock->save(new Entity('some_valid_name'))->shouldBeCalled();
//        $repositoryMock->save(new Entity('some_valid_name_2'))->shouldBeCalled();
//
//    }

    /**
     * @test
     */
    public function shouldSaveMultiple()
    {
        /** @var Repository $repositoryMock */
        $repositoryMock = $this->prophesize(Repository::class);

        /** @var Validator $validatorMock */
        $validatorMock = $this->prophesize(Validator::class);

        $validatorMock->isValid(Argument::which('getName', 'some_valid_name'))->willReturn(true);
        $validatorMock->isValid(new Entity('invalid_name'))->willReturn(false);
        $validatorMock->isValid(new Entity('some_valid_name_2'))->willReturn(true);

        $sut = new Service(
            $repositoryMock->reveal(),
            $validatorMock->reveal()
        );

        $data = [
            ['name' => 'some_valid_name'],
            ['name' => 'invalid_name'],
            ['name' => 'some_valid_name_2'],
        ];
        $sut->createMultiple($data);

        $repositoryMock->save(new TypeToken(Entity::class))->should(new CallTimesPrediction(2));

    }
}