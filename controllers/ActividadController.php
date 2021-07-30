<?php

require_once '../models/ActividadModel.php';

class ActividadController
{

    private $actividadModel;
    private $tabla = 'actividad';

    public function __construct()
    {
        $this->actividadModel = new ActividadModel;
    }

    public function guardar()
    {
        $this->actividadModel->guardar(['id_proceso' => $_POST['id_proceso'], 'orden_actividad' => $_POST['orden_actividad'], 'descripcion_actividad' => $_POST['de_actividad']]);
    }

    public function find()
    {
        $this->actividadModel->find($_POST['id_actividad']);
    }

    public function actualizar()
    {
        $this->actividadModel->actualizar(['descripcion_actividad' => $_POST['descripcion'], 'orden_actividad' => $_POST['orden']], $_POST['id_actividad']);
    }

    public function eliminar()
    {
        $this->actividadModel->eliminar($_POST['id_actividad']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Orden</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->actividadModel->searchTableWhere($this->tabla, 'id_proceso', $_POST['id_proceso']);
        foreach ($result as $r) {
            $data .= '<tr>
            <td align = "center">' . $r->orden_actividad . '</td>
            <td>' . $r->descripcion_actividad . '</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataActividad(' . $r->id_actividad . ')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarActividad(' . $r->id_actividad . ')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }

    public function llenarComboActividad()
    {
        $data = "<option value=''>Seleccione...</option>";
        $result = $this->actividadModel->consulta($_POST['id_proceso']);
        foreach ($result as $r) {
            $data .= "<option value='" . $r->id_actividad . "'>" . $r->descripcion_actividad . "</option>";
        }
        echo $data;
    }
}


$actividadController = new ActividadController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $actividadController->$accion();
}
