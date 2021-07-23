<?php

require_once '../models/RecursoModel.php';

class RecursoController{

    private $recursoModel;

    public function __construct () {
        $this->recursoModel = new RecursoModel;
    }

    public function guardar()
    {
        $this->recursoModel->guardar(['descripcion_recurso' => $_POST['descripcion']]);
    }

    public function find()
    {
        $this->recursoModel->find($_POST['id_recurso']);
    }

    public function actualizar()
    {
        $this->recursoModel->actualizar(['descripcion_recurso' => $_POST['descripcion']], $_POST['id_recurso']);
    }

    public function eliminar()
    {
        $this->recursoModel->eliminar($_POST['id_recurso']);
    }

}


$recursoController = new RecursoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $recursoController->$accion();
}

