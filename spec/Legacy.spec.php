<?php

use Kahlan\QuitException;
use Kahlan\Plugin\Quit;

describe('Legacy class', function () {
    describe('process method', function () {
        it('should return early', function () {

            Quit::disable();

            $sut = new \TestingLegacy\LegacyClass();

            $closure = function () use ($sut) {
                $sut->process([]);
            };
            expect($closure)->toThrow(new QuitException('Exit statement occurred'));

            Quit::enable();
        });

        it('should echo error when no entities found', function () {

            $repositoryMock = \Kahlan\Plugin\Double::instance(['class' => \TestingLegacy\Repository::class]);
            allow($repositoryMock)->toReceive('getAll')->andReturn([]);
            allow(\TestingLegacy\Repository::class)->toBe($repositoryMock);
            $sut = new \TestingLegacy\LegacyClass();

            $closure = function () use ($sut) {
                $sut->process(['same_data']);
            };
            expect($closure)->toEcho('error');
        });
    });
});