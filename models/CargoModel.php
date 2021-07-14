<?php

require_once 'Model.php';

class cargoModel extends Model{

    protected $table = 'cargo';

    protected $keyName = 'id_cargo';

}

$cargoModel = new cargoModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $cargoModel->$action(['descripcion_cargo' => $_POST['descripcion'], 'jefe_cargo' => $_POST['jefe_cargo']]);
            break;
            
        case 'find':
            $cargoModel->$action($_POST['id_cargo']);
            break;

        case 'actualizar':
            $cargoModel->$action(['descripcion_cargo' => $_POST['descripcion'], 'jefe_cargo' => $_POST['jefe_cargo']], $_POST['id_cargo']);
            break;

        case 'eliminar':
            $cargoModel->$action($_POST['id_cargo']);
            break;
    }
    
}