<?php

require_once 'Model.php';

class RecursoModel extends Model{

    protected $table = 'recurso';

    protected $keyName = 'id_recurso';

}

$recursoModel = new RecursoModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $recursoModel->$action(['descripcion_recurso' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $recursoModel->$action($_POST['id_recurso']);
            break;

        case 'actualizar':
            $recursoModel->$action(['descripcion_recurso' => $_POST['descripcion']], $_POST['id_recurso']);
            break;

        case 'eliminar':
            $recursoModel->$action($_POST['id_recurso']);
            break;
    }
    
}