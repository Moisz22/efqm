<?php

require_once '../models/SalidaModel.php';

class SalidaController{

    private $salidaModel;
    private $tabla = 'salida';

    public function __construct () {
        $this->salidaModel = new SalidaModel;
    }

    public function guardar()
    {
        $this->salidaModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_actividad' => $_POST['id_actividad'], 'descripcion_salida' => $_POST['descripcion_salida']]);
    }

    public function find()
    {
        $this->salidaModel->find($_POST['id_salida']);
    }

    public function actualizar()
    {
        $this->salidaModel->actualizar(['descripcion_salida' => $_POST['descripcion_salida'], 'id_actividad' => $_POST['id_actividad_salida']], $_POST['id_salida']);
    }

    public function eliminar()
    {
        $this->salidaModel->eliminar($_POST['id_salida']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_salida table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Actividad Asociada</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->salidaModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->descripcion_actividad.'</td>
            <td>'.$r->descripcion_salida.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataSalida('.$r->id_salida.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarSalida('.$r->id_salida.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_salida").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$salidaController = new SalidaController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $salidaController->$accion();
}