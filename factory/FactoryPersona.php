<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryPersona{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearPersona(){

        $stm = $this->db->prepare('SELECT * FROM cargo');
        $stm->execute();
        $resultados = $stm->fetchAll();

        if(sizeof($resultados) < $this->cantidadRegistros)

        /* for($i=0; $i < $this->cantidadRegistros; $i++){
            
            $dni_persona = $this->faker->numberBetween(1000000000,9999999999);
            $nombre = $this->faker->firstName;
            $apellido = $this->faker->lastName;
            $impresion_persona = $nombre .' ' . $apellido;

            $flag_empleado = $this->faker->randomElement([0,1]);

            $stm = $this->db->prepare('INSERT INTO persona(dni_persona, id_cargo, nombre_persona, apellido_persona, impresion_persona, flag_empleado) VALUES(:dni_persona, :id_cargo, :nombre_persona, :apellido_persona, :impresion_persona, :flag_empleado)');
            $stm->bindParam(':dni_persona', $dni_persona);
            $stm->bindParam(':id_cargo', $nombre);
            $stm->bindParam(':nombre_persona', $nombre);
            $stm->bindParam(':apellido_persona', $apellido);
            $stm->bindParam(':impresion_persona', $impresion_persona);
            $stm->bindParam(':flag_empleado', $flag_empleado);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' personas creadas correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' persona creada correctamente' : 'error'; */

    }
}

$factoryPersona = new FactoryPersona;
$factoryPersona->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryPersona->cantidadRegistros;
$factoryPersona->crearPersona();
