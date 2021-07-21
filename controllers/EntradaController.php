<?php

require_once '../models/EntradaModel.php';

class EntradaController{

    private $entradaModel;
    private $tabla = 'entrada';

    public function __construct () {
        $this->entradaModel = new EntradaModel;
    }

    public function guardar()
    {
        $this->entradaModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_actividad' => $_POST['id_actividad'], 'descripcion_entrada' => $_POST['descripcion_entrada']]);
    }

    public function find()
    {
        $this->entradaModel->find($_POST['id_entrada']);
    }

    public function actualizar()
    {
        $this->entradaModel->actualizar(['descripcion_entrada' => $_POST['descripcion_entrada'], 'id_actividad' => $_POST['id_actividad_entrada'], 'id_entrada' => $_POST['id_entrada']], $_POST['id_entrada']);
    }

    public function eliminar()
    {
        $this->entradaModel->eliminar($_POST['id_entrada']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_entrada table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Actividad Asociada</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->entradaModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->descripcion_actividad.'</td>
            <td>'.$r->descripcion_entrada.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataEntrada('.$r->id_entrada.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarEntrada('.$r->id_entrada.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_entrada").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$entradaController = new EntradaController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $entradaController->$accion();
}