<?php

require_once '../models/ControlCambioModel.php';

class ControlCambioController{

    private $controlCambioModel;

    public function __construct () {

        $this->controlCambioModel = new ControlCambioModel;
    }

    public function guardar()
    {
        $this->controlCambioModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_version' => $_POST['id_version'], 'descripcion_control_cambio' => $_POST['de_control_cambio']]);
    }

    
    public function find()
    {
        $this->controlCambioModel->find($_POST['id_control_cambio']);
    }
    
    public function actualizar()
    {
        $this->controlCambioModel->actualizar(['id_version' => $_POST['id_version'], 'descripcion_control_cambio' => $_POST['de_control_cambio']], $_POST['id_control_cambio']);
    }
    
    public function eliminar()
    {
        $this->controlCambioModel->eliminar($_POST['id_control_cambio']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_control_cambio table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Version</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->controlCambioModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->descripcion_version.'</td>
            <td>'.$r->descripcion_control_cambio.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataControlCambio('.$r->id_control_cambio.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarControlCambio('.$r->id_control_cambio.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_control_cambio").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }

    public function llenarComboControlCambio()
    {
        $data = "<option value=''>Seleccione...</option>";
        $result = $this->ControlCambioModel->searchTable('version');
        foreach ($result as $r)
        {
            $data .= "<option value='".$r->id_version."'>".$r->descripcion_version."</option>";
        }
        echo $data;
    }

}


$controlCambioController = new ControlCambioController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $controlCambioController->$accion();
}