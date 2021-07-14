<?php

require_once 'Model.php';

class TipoDocumentoModel extends Model{

    protected $table = 'tipo_documento';

    protected $keyName = 'id_tipo_documento';

}

$TipoDocumentoModel = new TipoDocumentoModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $TipoDocumentoModel->$action(['descripcion_tipo_documento' => $_POST['descripcion'], 'abreviatura_tipo_documento' => $_POST['abreviatura']  ]);
            break;
            
        case 'find':
            $TipoDocumentoModel->$action($_POST['id_tipo_documento']);
            break;

        case 'actualizar':
            $TipoDocumentoModel->$action(['descripcion_tipo_documento' => $_POST['descripcion'], 'abreviatura_tipo_documento' => $_POST['abreviatura']  ], $_POST['id_tipo_documento']);
            break;

        case 'eliminar':
            $TipoDocumentoModel->$action($_POST['id_tipo_documento']);
            break;
    }
    
}