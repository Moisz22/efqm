<?php

require_once 'config/config.php';
require_once 'config/Conexion.php';
require_once 'vendor/autoload.php';

class FactoryUsuario{

    private $faker;
    private $db;
    public $cantidadRegistros;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->db = Conexion::getConexion();
        $this->cantidadRegistros = 10;
    }

    public function crearUsuario(){

        for($i=0; $i < $this->cantidadRegistros; $i++){
            $cedula = $this->faker->numberBetween(1000000000,9999999999);
            $password = $this->faker->password(8, 10);
            $nombre = $this->faker->name;
            $correo = $this->faker->email;
            $grupo = $this->faker->numberBetween(1,5);
            $foto = $this->faker->imageUrl(640, 480, 'animals', true);
            $lider = $this->faker->randomElement([0,1]);
            $co_cargo = $this->faker->numberBetween(1000000000,9999999999);
            $co_institucion = $this->faker->numberBetween(1000000000,9999999999);
            $permiso_cronograma = $this->faker->numberBetween(1000000000,9999999999);

            $stm = $this->db->prepare('INSERT INTO usuarios(cedula_usuario, pw_usuario, nombre_usuario, correo_usuario, grupo_usuario, foto, lider, usuario_impresion, co_cargo, co_institucion, permiso_cronograma) VALUES(:cedula_usuario, :pw_usuario, :nombre_usuario, :correo_usuario, :grupo_usuario, :foto, :lider, :usuario_impresion, :co_cargo, :co_institucion, :permiso_cronograma)');
            $stm->bindParam(':cedula_usuario', $cedula);
            $stm->bindParam(':pw_usuario', $password);
            $stm->bindParam(':nombre_usuario', $nombre);
            $stm->bindParam(':correo_usuario', $correo);
            $stm->bindParam(':grupo_usuario', $grupo);
            $stm->bindParam(':foto', $foto);
            $stm->bindParam(':lider', $lider);
            $stm->bindParam(':usuario_impresion', $nombre);
            $stm->bindParam(':co_cargo', $co_cargo);
            $stm->bindParam(':co_institucion', $co_institucion);
            $stm->bindParam(':permiso_cronograma', $permiso_cronograma);
            $stm->execute();
        }

        if($this->cantidadRegistros>1) echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' personas creadas correctamente' : 'error';
        else echo ($stm->rowCount()>0) ? $this->cantidadRegistros . ' persona creada correctamente' : 'error';

    }
}

$factoryUsuarios = new FactoryUsuario;
$factoryUsuarios->cantidadRegistros = (isset($argv[1]) && !empty($argv[1])) ? $argv[1] : $factoryUsuarios->cantidadRegistros;
$factoryUsuarios->crearUsuario();
