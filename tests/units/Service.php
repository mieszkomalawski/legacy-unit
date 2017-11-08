<?php

namespace TestingLegacy\Tests\units;

require_once __DIR__ . '/../../vendor/autoload.php';


use atoum;
use TestingLegacy\Validator;

class Service extends atoum
{
    public function testSay()
    {

        $validatorMock = new \mock\TestingLegacy\Validator();
        $repositoryMock = new \mock\TestingLegacy\Repository();
    }
}