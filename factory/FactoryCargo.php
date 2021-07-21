<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';
require_once 'Factory.php';

class FactoryCargo extends Factory{

    private $faker;
    private $db;
    public $cantidadRegistros;
    public $trabajos;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
        $this->trabajos = array_merge($this->systems, $this->humanResources, $this->marketing);
    }

    public function crearCargo(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $cargo = $this->faker->unique()->randomElement($this->trabajos);
            $stm = $this->db->prepare('INSERT INTO cargo(descripcion_cargo) VALUES(:descripcion_cargo)');
            $stm->bindParam(':descripcion_cargo', $cargo);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' cargos creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' cargo creado correctamente' : 'error';

    }
}

$factoryCargo = new FactoryCargo;
$factoryCargo->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryCargo->cantidadRegistros;
$factoryCargo->crearCargo();