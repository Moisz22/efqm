<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryTipoDocumento{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearTipoDocumento(){

        for($i=0; $i<$this->cantidadRegistros; $i++){
            
            $tipo = $this->faker->word;
            $abreviatura_tipo = substr($tipo, 0, 5);

            $stm = $this->db->prepare('INSERT INTO tipo_documento(descripcion_tipo_documento, abreviatura_tipo_documento) VALUES(:descripcion_tipo_documento, :abreviatura_tipo_documento)');
            $stm->bindParam(':descripcion_tipo_documento', $tipo);
            $stm->bindParam(':abreviatura_tipo_documento', $abreviatura_tipo);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' tipo de documentos creados correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' tipo de documento creado correctamente' : 'error';

    }
}

$factoryTipoDocumento = new FactoryTipoDocumento;
$factoryTipoDocumento->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryTipoDocumento->cantidadRegistros;
$factoryTipoDocumento->crearTipoDocumento();
