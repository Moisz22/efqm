<?php

require_once '../models/RecursoProcesoModel.php';

class RecursoProcesoController{

    private $recursoProcesoModel;
    private $tabla = 'recurso_proceso';

    public function __construct () {
        $this->recursoProcesoModel = new RecursoProcesoModel;
    }

    public function guardar()
    {
        $this->recursoProcesoModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_actividad' => $_POST['id_actividad_recurso_proceso'], 'id_recurso' => $_POST['id_recurso']]);
    }

    public function find()
    {
        $this->recursoProcesoModel->find($_POST['id_recurso_proceso']);
    }

    public function actualizar()
    {
        $this->recursoProcesoModel->actualizar(['id_actividad' => $_POST['id_actividad_recurso_proceso'], 'id_recurso' => $_POST['id_recurso']], $_POST['id_recurso_proceso']);
    }

    public function eliminar()
    {
        $this->recursoProcesoModel->eliminar($_POST['id_recurso_proceso']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_recursoProceso table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Actividad Asociada</th>
                <th>Recurso</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->recursoProcesoModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->descripcion_actividad.'</td>
            <td>'.$r->descripcion_recurso.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataRecursoProceso('.$r->id_recurso_proceso.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarRecursoProceso('.$r->id_recurso_proceso.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_recursoProceso").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$recursoProcesoController = new RecursoProcesoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $recursoProcesoController->$accion();
}