<?php

require_once '../models/TipoDocumentoModel.php';

class TipoDocumentoController{

    private $tipoDocumentoModel;

    public function __construct () {
        $this->tipoDocumentoModel = new TipoDocumentoModel;
    }

    public function guardar()
    {
        $this->tipoDocumentoModel->guardar(['descripcion_tipo_documento' => $_POST['descripcion'], 'abreviatura_tipo_documento' => $_POST['abreviatura']  ]);
    }

    public function find()
    {
        $this->tipoDocumentoModel->find($_POST['id_tipo_documento']);
    }

    public function actualizar()
    {
        $this->tipoDocumentoModel->actualizar(['descripcion_tipo_documento' => $_POST['descripcion'], 'abreviatura_tipo_documento' => $_POST['abreviatura']  ], $_POST['id_tipo_documento']);
    }

    public function eliminar()
    {
        $this->tipoDocumentoModel->eliminar($_POST['id_tipo_documento']);
    }
}


$tipoDocumentoController = new TipoDocumentoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $tipoDocumentoController->$accion();
}