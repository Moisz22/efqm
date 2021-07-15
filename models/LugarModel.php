<?php

require_once 'Model.php';

class LugarModel extends Model{

    protected $table = 'lugar';

    protected $keyName = 'id_lugar';

}

$lugarModel = new LugarModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $lugarModel->$action(['descripcion_lugar' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $lugarModel->$action($_POST['id_lugar']);
            break;

        case 'actualizar':
            $lugarModel->$action(['descripcion_lugar' => $_POST['descripcion']], $_POST['id_lugar']);
            break;

        case 'eliminar':
            $lugarModel->$action($_POST['id_lugar']);
            break;
    }
    
}