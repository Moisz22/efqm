<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryTipoProceso{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearTipoProceso(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $tipo = $this->faker->word;
            $abreviatura_tipo = substr($tipo, 0, 5);

            $stm = $this->db->prepare('INSERT INTO tipo_proceso(descripcion_tipo_proceso, abreviatura_tipo_proceso) VALUES(:descripcion_tipo_proceso, :abreviatura_tipo_proceso)');
            $stm->bindParam(':descripcion_tipo_proceso', $tipo);
            $stm->bindParam(':abreviatura_tipo_proceso', $abreviatura_tipo);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' tipos de proceso creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' tipo de proceso creado correctamente' : 'error';

    }
}

$factoryTipoProceso = new FactoryTipoProceso;
$factoryTipoProceso->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryTipoProceso->cantidadRegistros;
$factoryTipoProceso->crearTipoProceso();
