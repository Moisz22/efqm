<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryRecurso{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearRecurso(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            $nombre = $this->faker->word;

            $stm = $this->db->prepare('INSERT INTO recurso(descripcion_recurso) VALUES(:descripcion_recurso)');
            $stm->bindParam(':descripcion_recurso', $nombre);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' recursos creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' recurso creado correctamente' : 'error';

    }
}

$factoryRecurso = new FactoryRecurso;
$factoryRecurso->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryRecurso->cantidadRecursos;
$factoryRecurso->crearRecurso();
