<?php

use PHPUnit\Framework\TestCase;

class FactoryVersionTest extends TestCase{

    public function testGuardarVersiones()
    {   
        $argv[1] = 15;
        require_once 'factory/FactoryVersion.php';
        $this->expectOutputString('15 versiones creadas correctamente');
        
    }

}