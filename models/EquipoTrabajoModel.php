<?php

require_once 'Model.php';

class EquipoTrabajoModel extends Model{

    protected $table = 'equipo_trabajo';

    protected $keyName = 'id_equipo_trabajo';

}

$equipoTrabajoModel = new EquipoTrabajoModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $equipoTrabajoModel->$action(['descripcion_equipo_trabajo' => $_POST['descripcion'] ]);
            break;
            
        case 'find':
            $equipoTrabajoModel->$action($_POST['id_equipo_trabajo']);
            break;

        case 'actualizar':
            $equipoTrabajoModel->$action(['descripcion_equipo_trabajo' => $_POST['descripcion']], $_POST['id_equipo_trabajo']);
            break;

        case 'eliminar':
            $equipoTrabajoModel->$action($_POST['id_equipo_trabajo']);
            break;
    }
    
}