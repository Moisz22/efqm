<?php
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
        $this->assertFileExists('models/Model.php', 'el modelo Model.php no existe');
        $resultado = $this->model->all();
        $this->assertIsArray($resultado, 'no se estan devolviendo los datos del modelo');
    }

    public function testSave()
    {
        $resultado = $this->model->save(['name_user' => $this->faker->name, 'email_user' => $this->faker->email, 'password_user' => $this->faker->password(6,20), 'id_rol' => $this->faker->randomElement([1,2])]);
        $this->assertEquals('ok', $resultado);
    }

    public function testFind()
    {
        $resultado = $this->model->find(5);
        $this->assertIsArray($resultado);
        $resultado2 = $this->model->find(0);
        $this->assertEmpty($resultado2);
    }

    public function testDestroy()
    {
        $conexion = Conexion::getConexion();
        $stm = $conexion->prepare('SELECT MAX(id) AS id FROM users');
        $stm->execute();
        $resultados = $stm->fetchAll();
        $ultimo_id = $resultados[0]['id'];
        $resultado = $this->model->destroy($ultimo_id);
        $this->assertEquals('ok', $resultado);
    }

    public function testUpdate()
    {
        $resultado = $this->model->update(['name_user' => $this->faker->name, 'email_user' => $this->faker->email], 5);
        $this->assertEquals('ok',$resultado);
    }

    protected function tearDown(): void
    {
        $this->model = null;
    }

}