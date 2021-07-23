<?php

require_once '../models/FrecuenciaModel.php';

class FrecuenciaController{

    private $frecuenciaModel;

    public function __construct () {
        $this->frecuenciaModel = new FrecuenciaModel;
    }

    public function guardar()
    {
        $this->frecuenciaModel->guardar(['descripcion_frecuencia' => $_POST['descripcion']]);
    }

    public function find()
    {
        $this->frecuenciaModel->find($_POST['id_frecuencia']);
    }

    public function actualizar()
    {
        $this->frecuenciaModel->actualizar(['descripcion_frecuencia' => $_POST['descripcion']], $_POST['id_frecuencia']);
    }

    public function eliminar()
    {
        $this->frecuenciaModel->eliminar($_POST['id_frecuencia']);
    }

}


$frecuenciaController = new frecuenciaController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $frecuenciaController->$accion();
}

