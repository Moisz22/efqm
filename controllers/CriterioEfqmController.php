<?php

require_once '../models/CriterioEfqmModel.php';

class CriterioEfqmController{

    private $criterioEfqmModel;

    public function __construct () {
        $this->criterioEfqmModel = new CriterioEfqmModel;
    }

    public function guardar()
    {
        $this->criterioEfqmModel->guardar(['descripcion_criterio_efqm' => $_POST['descripcion'], 'abreviatura_criterio_efqm' => $_POST['abreviatura']  ]);
    }

    public function find()
    {
        $this->criterioEfqmModel->find($_POST['id_criterio_efqm']);
    }

    public function actualizar()
    {
        $this->criterioEfqmModel->actualizar(['descripcion_criterio_efqm' => $_POST['descripcion'], 'abreviatura_criterio_efqm' => $_POST['abreviatura']  ], $_POST['id_criterio_efqm']);
    }

    public function eliminar()
    {
        $this->criterioEfqmModel->eliminar($_POST['id_criterio_efqm']);
    }
}


$criterioEfqmController = new CriterioEfqmController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $criterioEfqmController->$accion();
}