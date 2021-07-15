<?php

require_once '../../config/config.php';
require_once '../../config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryRecurso{

    public $faker;
    private $db;

    public function __construct()
    {
        $faker = $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
    }

    public function crearRecurso(){

        $stm = $this->db->prepare('INSERT INTO (descripcion_recurso) VALUES(:descripcion_recurso)');
        $stm->bindParam(':descripcion_recurso', $this->faker->name);
        $stm->execute();

    }
}
