<?php

require_once '../models/PoliticaModel.php';

class PoliticaController{

    private $politicaModel;
    private $tabla = 'politica';

    public function __construct () {
        $this->politicaModel = new PoliticaModel;
    }

    public function guardar()
    {
        $this->politicaModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_actividad' => $_POST['id_actividad_politica'], 'descripcion_politica' => $_POST['descripcion_politica'], 'orden_politica' => $_POST['orden_politica']]);
    }

    public function find()
    {
        $this->politicaModel->find($_POST['id_politica']);
    }

    public function actualizar()
    {
        $this->politicaModel->actualizar(['id_actividad' => $_POST['id_actividad_politica'], 'descripcion_politica' => $_POST['descripcion_politica'], 'orden_politica' => $_POST['orden_politica']], $_POST['id_politica']);
    }

    public function eliminar()
    {
        $this->politicaModel->eliminar($_POST['id_politica']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_politica table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Orden</th>    
                <th>Actividad Asociada</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->politicaModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->orden_politica.'</td>
            <td align = "center">'.$r->descripcion_actividad.'</td>
            <td>'.$r->descripcion_politica.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataPolitica('.$r->id_politica.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarPolitica('.$r->id_politica.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_politica").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$politicaController = new PoliticaController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $politicaController->$accion();
}