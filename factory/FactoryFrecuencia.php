<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryFrecuencia{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearFrecuencia(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $frecuencia = $this->faker->word;

            $stm = $this->db->prepare('INSERT INTO frecuencia(descripcion_frecuencia) VALUES(:descripcion_frecuencia)');
            $stm->bindParam(':descripcion_frecuencia', $frecuencia);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' frencuencias creadas correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' frencuencia creada correctamente' : 'error';

    }
}

$factoryFrecuencia = new FactoryFrecuencia;
$factoryFrecuencia->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryFrecuencia->cantidadRegistros;
$factoryFrecuencia->crearFrecuencia();
