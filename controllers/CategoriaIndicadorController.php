<?php

require_once '../models/CategoriaIndicadorModel.php';

class CategoriaIndicadorController{

    private $categoriaIndicadorModel;

    public function __construct () {
        $this->categoriaIndicadorModel = new CategoriaIndicadorModel;
    }

    public function guardar()
    {
        $this->categoriaIndicadorModel->guardar(['descripcion_categoria_indicador' => $_POST['descripcion'] ]);
    }

    public function find()
    {
        $this->categoriaIndicadorModel->find($_POST['id_categoria_indicador']);
    }

    public function actualizar()
    {
        $this->categoriaIndicadorModel->actualizar(['descripcion_categoria_indicador' => $_POST['descripcion']], $_POST['id_categoria_indicador']);
    }

    public function eliminar()
    {
        $this->categoriaIndicadorModel->eliminar($_POST['id_categoria_indicador']);
    }
}


$categoriaIndicadorController = new CategoriaIndicadorController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $categoriaIndicadorController->$accion();
}