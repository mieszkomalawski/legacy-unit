<?php

describe('static class', function(){
    it('should count entities', function(){
        allow(\TestingLegacy\DB::class)->toReceive('::getAll')->andReturn([
            new \TestingLegacy\Entity('a'),
            new \TestingLegacy\Entity('b')
        ]);

        $sut = new \TestingLegacy\StaticExample();

        expect($sut->foo())->toBe(2);
    });
});