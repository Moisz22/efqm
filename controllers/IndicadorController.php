<?php

require_once '../models/IndicadorModel.php';

class IndicadorController{

    private $indicadorModel;

    public function __construct () {
        $this->indicadorModel = new IndicadorModel;
    }

    public function guardarIndicador()
    {
        $this->indicadorModel->guardarIndicador(['descripcion_indicador' => $_POST['nombre_indicador'], 'formula_indicador' => $_POST['formula_indicador'], 'id_criterio_efqm ' => $_POST['criterio_efqm'], 'meta_indicador' => $_POST['meta_indicador'], 'id_frecuencia_indicador' => $_POST['frecuencia_indicador'], 'id_categoria_indicador' => $_POST['categoria_indicador']]);
    }

    public function find()
    {
        $this->indicadorModel->find($_POST['id_indicador']);
    }

    public function actualizar()
    {
        $this->indicadorModel->actualizar(['descripcion_indicador' => $_POST['nombre_indicador'], 'formula_indicador' => $_POST['formula_indicador'], 'id_criterio_efqm ' => $_POST['criterio_efqm'], 'meta_indicador' => $_POST['meta_indicador'], 'id_frecuencia_indicador' => $_POST['frecuencia_indicador'], 'id_categoria_indicador' => $_POST['categoria_indicador']], $_POST['id_indicador']);
    }

    public function eliminar()
    {
        $this->indicadorModel->eliminar($_POST['id_indicador']);
    }

}


$indicadorController = new IndicadorController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $indicadorController->$accion();
}

