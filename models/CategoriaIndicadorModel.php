<?php

require_once 'Model.php';

class CategoriaIndicadorModel extends Model{

    protected $table = 'categoria_indicador';

    protected $keyName = 'id_categoria_indicador';

}

$CategoriaIndicadorModel = new CategoriaIndicadorModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $CategoriaIndicadorModel->$action(['descripcion_categoria_indicador' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $CategoriaIndicadorModel->$action($_POST['id_categoria_indicador']);
            break;

        case 'actualizar':
            $CategoriaIndicadorModel->$action(['descripcion_categoria_indicador' => $_POST['descripcion']], $_POST['id_categoria_indicador']);
            break;

        case 'eliminar':
            $CategoriaIndicadorModel->$action($_POST['id_categoria_indicador']);
            break;
    }
    
}