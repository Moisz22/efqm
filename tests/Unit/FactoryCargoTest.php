<?php

use PHPUnit\Framework\TestCase;

class FactoryCargoTest extends TestCase{

    public function testGuardarCargo()
    {   
        require_once 'factory/FactoryCargo.php';
        $this->expectOutputString('10 cargos creados correctamente');
        
    }

}