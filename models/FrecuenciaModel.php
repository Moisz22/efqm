<?php

require_once 'Model.php';

class frecuenciaModel extends Model{

    protected $table = 'frecuencia';

    protected $keyName = 'id_frecuencia';

}

$frecuenciaModel = new frecuenciaModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $frecuenciaModel->$action(['descripcion_frecuencia' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $frecuenciaModel->$action($_POST['id_frecuencia']);
            break;

        case 'actualizar':
            $frecuenciaModel->$action(['descripcion_frecuencia' => $_POST['descripcion']], $_POST['id_frecuencia']);
            break;

        case 'eliminar':
            $frecuenciaModel->$action($_POST['id_frecuencia']);
            break;
    }
    
}