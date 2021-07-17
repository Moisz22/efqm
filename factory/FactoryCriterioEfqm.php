<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryCriterioEfqm{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearCriterioEfqm(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $criterio = $this->faker->word;
            $abreviatura = substr($criterio, 0, 5);

            $stm = $this->db->prepare('INSERT INTO criterio_efqm(descripcion_criterio_efqm, abreviatura_criterio_efqm) VALUES(:descripcion_criterio_efqm, :abreviatura_criterio_efqm)');
            $stm->bindParam(':descripcion_criterio_efqm', $criterio);
            $stm->bindParam(':abreviatura_criterio_efqm', $abreviatura);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' criterios efqm creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' criterio efqm creado correctamente' : 'error';

    }
}

$factoryCriterioEfqm = new FactoryCriterioEfqm;
$factoryCriterioEfqm->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryCriterioEfqm->cantidadRegistros;
$factoryCriterioEfqm->crearCriterioEfqm();
