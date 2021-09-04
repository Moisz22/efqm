<?php

require_once '../models/LoginModel.php';

class LoginController
{
    private $Model;

    public function __construct()
    {
        $this->Model = new LoginModel;
    }

    public function login()
    {
        $resultado = $this->Model->login($_POST['user'], hash('sha512', $_POST['pwd']));
        if (!empty($resultado))
        {
            session_start();
            $_SESSION["id_usuario"] = $resultado[0]->id_usuario;
            $_SESSION["id_persona"] = $resultado[0]->id_persona;
		    $_SESSION["nombre"] = $resultado[0]->nombres;
            $_SESSION["rol"] = $resultado[0]->id_rol;
            echo 'ok';
        }
        else
            echo 'error';
    }
}


$LoginController = new LoginController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $LoginController->$accion();
}
