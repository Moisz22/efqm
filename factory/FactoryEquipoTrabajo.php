<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryEquipoTrabajo{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearEquipoTrabajo(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $equipo = $this->faker->word;

            $stm = $this->db->prepare('INSERT INTO equipo_trabajo(descripcion_equipo_trabajo) VALUES(:descripcion_equipo_trabajo)');
            $stm->bindParam(':descripcion_equipo_trabajo', $equipo);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' equipos de trabajo creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' equipo de trabajo creado correctamente' : 'error';

    }
}

$factoryEquipoTrabajo = new FactoryEquipoTrabajo;
$factoryEquipoTrabajo->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryEquipoTrabajo->cantidadRegistros;
$factoryEquipoTrabajo->crearEquipoTrabajo();
