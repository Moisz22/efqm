<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryCategoriaIndicador{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearCategoriaIndicador(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $categoria_indicador = $this->faker->word;

            $stm = $this->db->prepare('INSERT INTO categoria_indicador(descripcion_categoria_indicador) VALUES(:descripcion_categoria_indicador)');
            $stm->bindParam(':descripcion_categoria_indicador', $categoria_indicador);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' categorias indicador creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' categoria indicador creado correctamente' : 'error';

    }
}

$factoryCategoriaIndicador = new FactoryCategoriaIndicador;
$factoryCategoriaIndicador->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryCategoriaIndicador->cantidadRegistros;
$factoryCategoriaIndicador->crearCategoriaIndicador();
