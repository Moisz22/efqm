<?php

require_once '../models/EquipoTrabajoModel.php';

class EquipoTrabajoController{

    private $EquipoTrabajoModel;

    public function __construct () {
        $this->EquipoTrabajoModel = new EquipoTrabajoModel;
    }

    public function guardar()
    {
        $this->EquipoTrabajoModel->guardar(['descripcion_equipo_trabajo' => $_POST['descripcion']]);
    }

    public function find()
    {
        $this->EquipoTrabajoModel->find($_POST['id_equipo_trabajo']);
    }

    public function actualizar()
    {
        $this->EquipoTrabajoModel->actualizar(['descripcion_equipo_trabajo' => $_POST['descripcion']], $_POST['id_equipo_trabajo']);
    }

    public function eliminar()
    {
        $this->EquipoTrabajoModel->eliminar($_POST['id_equipo_trabajo']);
    }

}


$equipoTrabajoController = new EquipoTrabajoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $equipoTrabajoController->$accion();
}

