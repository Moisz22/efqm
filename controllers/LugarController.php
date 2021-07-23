<?php

require_once '../models/LugarModel.php';

class LugarController{

    private $lugarModel;

    public function __construct () {
        $this->lugarModel = new LugarModel;
    }

    public function guardar()
    {
        $this->lugarModel->guardar(['descripcion_lugar' => $_POST['descripcion'] ]);
    }

    public function find()
    {
        $this->lugarModel->find($_POST['id_lugar']);
    }

    public function actualizar()
    {
        $this->lugarModel->actualizar(['descripcion_lugar' => $_POST['descripcion']], $_POST['id_lugar']);
    }

    public function eliminar()
    {
        $this->lugarModel->eliminar($_POST['id_lugar']);
    }
}


$lugarController = new LugarController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $lugarController->$accion();
}