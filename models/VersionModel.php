<?php

require_once 'Model.php';

class VersionModel extends Model{

    protected $table = 'version';

    protected $keyName = 'id_version';
}

$versionModel = new VersionModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $versionModel->$action(['descripcion_version' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $versionModel->$action($_POST['id_version']);
            break;

        case 'actualizar':
            $versionModel->$action(['descripcion_version' => $_POST['descripcion']], $_POST['id_version']);
            break;

        case 'eliminar':
            $versionModel->$action($_POST['id_version']);
            break;
    }
    
}