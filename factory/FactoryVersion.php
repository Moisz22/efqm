<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryVersion{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearVersion(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $version = $this->faker->unique()->randomFloat(1,0,10);
            $stm = $this->db->prepare('INSERT INTO version(descripcion_version) VALUES(:descripcion_version)');
            $stm->bindParam(':descripcion_version', $version);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' versiones creadas correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' version creada correctamente' : 'error';

    }
}

$factoryVersion = new FactoryVersion;
$factoryVersion->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryVersion->cantidadRegistros;
$factoryVersion->crearVersion();
