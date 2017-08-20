<?php

describe('static class', function(){
    it('should count entities', function(){
        allow(\PHPUnitAlt\DB::class)->toReceive('::getAll')->andReturn([
            new \PHPUnitAlt\Entity('a'),
            new \PHPUnitAlt\Entity('b')
        ]);

        $sut = new \PHPUnitAlt\StaticExample();

        expect($sut->foo())->toBe(2);
    });
});