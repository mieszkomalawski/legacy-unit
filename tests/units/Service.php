<?php

namespace PHPUnitAlt\Tests\units;

require_once __DIR__ . '/../../vendor/autoload.php';


use atoum;
use PHPUnitAlt\Validator;

class Service extends atoum
{
    public function testSay()
    {
        //$this->string('dupa')->isEqualTo('dupa');

        $validatorMock = new \mock\PHPUnitAlt\Validator();
        $repositoryMock = new \mock\PHPUnitAlt\Repository();
    }
}