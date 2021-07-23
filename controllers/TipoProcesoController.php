<?php

require_once '../models/TipoProcesoModel.php';

class TipoProcesoController{

    private $tipoProcesoModel;

    public function __construct () {
        $this->tipoProcesoModel = new TipoProcesoModel;
    }

    public function guardar()
    {
        $this->tipoProcesoModel->guardar(['descripcion_tipo_proceso' => $_POST['descripcion'], 'abreviatura_tipo_proceso' => $_POST['abreviatura']]);
    }

    public function find()
    {
        $this->tipoProcesoModel->find($_POST['id_tipo_proceso']);
    }

    public function actualizar()
    {
        $this->tipoProcesoModel->actualizar(['descripcion_tipo_proceso' => $_POST['descripcion'], 'abreviatura_tipo_proceso' => $_POST['abreviatura']], $_POST['id_tipo_proceso']);
    }

    public function eliminar()
    {
        $this->tipoProcesoModel->eliminar($_POST['id_tipo_proceso']);
    }

}


$tipoProcesoController = new TipoProcesoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $tipoProcesoController->$accion();
}

