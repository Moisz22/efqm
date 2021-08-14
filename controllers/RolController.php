<?php

require_once '../models/RolModel.php';

class RolController{

    private $rolModel;

    public function __construct () {
        $this->rolModel = new RolModel;
    }

    public function guardar()
    {
        $this->rolModel->guardarRol(['descripcion_rol' => $_POST['descripcion']]);
    }

    public function find()
    {
        $this->rolModel->find($_POST['id_rol']);
    }

    public function actualizar()
    {
        $this->rolModel->actualizar(['descripcion_rol' => $_POST['descripcion']], $_POST['id_rol']);
    }

    public function eliminar()
    {
        $this->rolModel->eliminar($_POST['id_rol']);
    }

}


$rolController = new RolController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $rolController->$accion();
}

