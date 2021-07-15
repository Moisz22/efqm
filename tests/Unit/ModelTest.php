<?php

/* para probar este test, se debe poner en el modelo el require de config/Conexion.php 
    protected $table = 'recurso';
    protected $keyName = 'id_recurso';
    en find agregar al final return $resultado;
*/

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'models/Model.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase{
    
    protected $faker;
    protected $model;

    protected function setUp(): void
    {
        $this->faker = Faker\Factory::create();
        $this->model = new Model;
    }

    public function testAll()
    {
        $resultado = $this->model->all();
        $this->assertIsArray($resultado);
    }

    public function testGuardar()
    {
        $resultado = $this->model->guardar(['descripcion_recurso' => $this->faker->name]);
        $this->expectOutputString('ok');
    }

    public function testFind()
    {
        // Suppress  output to console
        $this->setOutputCallback(function() {});

        $conexion = Conexion::getConexion();
        $stm = $conexion->prepare('SELECT MAX(id_recurso) AS id FROM recurso');
        $stm->execute();
        $resultados = $stm->fetchAll();
        $ultimo_id = $resultados[0]['id'];

        $resultado = $this->model->find($ultimo_id);
        $this->assertIsArray($resultado);
        $this->assertNotEmpty($resultado);
    }

    public function testUpdate()
    {
        $conexion = Conexion::getConexion();
        $stm = $conexion->prepare('SELECT MAX(id_recurso) AS id FROM recurso');
        $stm->execute();
        $resultados = $stm->fetchAll();
        $ultimo_id = $resultados[0]['id'];

        $resultado = $this->model->actualizar(['descripcion_recurso' => $this->faker->name], $ultimo_id);
        $this->expectOutputString('ok');
    }

    public function testEliminar()
    {
        $conexion = Conexion::getConexion();
        $stm = $conexion->prepare('SELECT MAX(id_recurso) AS id FROM recurso');
        $stm->execute();
        $resultados = $stm->fetchAll();
        $ultimo_id = $resultados[0]['id'];

        $resultado = $this->model->eliminar($ultimo_id);
        $this->expectOutputString('ok');
    }

    protected function tearDown(): void
    {
        $this->model = null;
    }

}