<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryLugar{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearLugar(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $lugar = $this->faker->address;

            $stm = $this->db->prepare('INSERT INTO lugar(descripcion_lugar) VALUES(:descripcion_lugar)');
            $stm->bindParam(':descripcion_lugar', $lugar);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' lugares creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' lugar creado correctamente' : 'error';

    }
}

$factoryLugar = new FactoryLugar;
$factoryLugar->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryLugar->cantidadRegistros;
$factoryLugar->crearLugar();
