<?php

require_once '../models/UsuarioModel.php';
require_once '../models/PersonaModel.php';

class UsuarioController{

    private $usuarioModel;
    private $personaModel;

    public function __construct () {
        $this->usuarioModel = new UsuarioModel;
        $this->personaModel = new PersonaModel;
    }

    public function guardar()
    {
        $this->usuarioModel->guardar(['id_persona' => $_POST['id_persona'], 'username' => $_POST['username'], 'password' => hash('sha512', $_POST['username']), 'id_rol' => $_POST['id_rol'], 'equipo_usuario' => $_POST['equipo_trabajo']]);
    }

    public function find()
    {
        $this->personaModel->find($_POST['id_persona']);
    }

    public function actualizar()
    {
        $this->usuarioModel->actualizar(['descripcion_usuario' => $_POST['descripcion']], $_POST['id_usuario']);
    }

    public function eliminar()
    {
        $this->usuarioModel->eliminar($_POST['id_usuario']);
    }

}


$usuarioController = new UsuarioController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $usuarioController->$accion();
}

