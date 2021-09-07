<?php

require_once '../models/UsuarioModel.php';
require_once '../models/PersonaModel.php';

class UsuarioController
{

    private $usuarioModel;
    private $personaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel;
        $this->personaModel = new PersonaModel;
    }

    public function guardar()
    {
        $this->usuarioModel->guardar(['id_persona' => $_POST['id_persona'], 'username' => $_POST['username'], 'password' => hash('sha512', $_POST['username']), 'id_rol' => $_POST['id_rol'], 'equipo_usuario' => $_POST['equipo_trabajo']]);
    }

    public function find()
    {
        $this->usuarioModel->find($_POST['id_usuario']);
    }

    public function actualizar()
    {
        $this->usuarioModel->actualizar(['id_rol' => $_POST['id_rol'], 'equipo_usuario' => $_POST['equipo_trabajo']], $_POST['id_usuario']);
    }

    public function eliminar()
    {
        $this->usuarioModel->eliminar($_POST['id_usuario']);
    }

    public function cambiaPassword()
    {
        $validacion = $this->usuarioModel->consultaUsuario($_POST['id_usuario'], hash('sha512', $_POST['contrasena_actual']));
        if (!empty($validacion)) {
            if ($_POST['nueva_contrasena'] == $_POST['confirmacion_nueva_contrasena']) {
                $this->usuarioModel->actualizar(['password' => hash('sha512', $_POST['nueva_contrasena'])], $_POST['id_usuario']);
            } else
                echo 'Las contraseñas ingresadas no coinciden';
        } else
            echo 'La contraseña actual no es la correcta';
    }
}


$usuarioController = new UsuarioController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $usuarioController->$accion();
}
