<?php

require_once 'Model.php';

class TipoProcesoModel extends Model{

    protected $table = 'tipo_proceso';

    protected $keyName = 'id_tipo_proceso';

}

$TipoProcesoModel = new TipoProcesoModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $TipoProcesoModel->$action(['descripcion_tipo_proceso' => $_POST['descripcion'], 'abreviatura_tipo_proceso' => $_POST['abreviatura']  ]);
            break;
            
        case 'find':
            $TipoProcesoModel->$action($_POST['id_tipo_proceso']);
            break;

        case 'actualizar':
            $TipoProcesoModel->$action(['descripcion_tipo_proceso' => $_POST['descripcion'], 'abreviatura_tipo_proceso' => $_POST['abreviatura']  ], $_POST['id_tipo_proceso']);
            break;

        case 'eliminar':
            $TipoProcesoModel->$action($_POST['id_tipo_proceso']);
            break;
    }
    
}