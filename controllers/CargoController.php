<?php

require_once '../models/CargoModel.php';

class CargoController{

    private $cargoModel;

    public function __construct () {
        $this->cargoModel = new CargoModel;
    }

    public function guardar()
    {
        $this->cargoModel->guardar(['descripcion_cargo' => $_POST['descripcion'], 'jefe_cargo' => $_POST['jefe_cargo'] ]);
    }

    public function find()
    {
        $this->cargoModel->find($_POST['id_cargo']);
    }

    public function actualizar()
    {
        $this->cargoModel->actualizar(['descripcion_cargo' => $_POST['descripcion'], 'jefe_cargo' => $_POST['jefe_cargo']], $_POST['id_cargo']);
    }

    public function eliminar()
    {
        $this->cargoModel->eliminar($_POST['id_cargo']);
    }

}


$cargoController = new CargoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $cargoController->$accion();
}

