<?php

require_once '../models/VersionModel.php';

class VersionController{

    private $versionModel;

    public function __construct () {
        $this->versionModel = new VersionModel;
    }

    public function guardar()
    {
        $this->versionModel->guardar(['descripcion_version' => $_POST['descripcion']]);
    }

    public function find()
    {
        $this->versionModel->find($_POST['id_version']);
    }

    public function actualizar()
    {
        $this->versionModel->actualizar(['descripcion_version' => $_POST['descripcion']], $_POST['id_version']);
    }

    public function eliminar()
    {
        $this->versionModel->eliminar($_POST['id_version']);
    }

}


$versionController = new VersionController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $versionController->$accion();
}

