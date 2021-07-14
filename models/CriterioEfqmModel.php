<?php

require_once 'Model.php';

class CriterioEfqmModel extends Model{

    protected $table = 'criterio_efqm';

    protected $keyName = 'id_criterio_efqm';

}

$CriterioEfqmModel = new CriterioEfqmModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $CriterioEfqmModel->$action(['descripcion_criterio_efqm' => $_POST['descripcion'], 'abreviatura_criterio_efqm' => $_POST['abreviatura']  ]);
            break;
            
        case 'find':
            $CriterioEfqmModel->$action($_POST['id_criterio_efqm']);
            break;

        case 'actualizar':
            $CriterioEfqmModel->$action(['descripcion_criterio_efqm' => $_POST['descripcion'], 'abreviatura_criterio_efqm' => $_POST['abreviatura']  ], $_POST['id_criterio_efqm']);
            break;

        case 'eliminar':
            $CriterioEfqmModel->$action($_POST['id_criterio_efqm']);
            break;
    }
    
}