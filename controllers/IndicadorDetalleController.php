<?php

require_once '../models/IndicadorDetalleModel.php';

class IndicadorDetalleController
{

    private $indicadorDetalleModel;
    private $tabla = 'indicador_detalle';

    public function __construct()
    {
        $this->indicadorDetalleModel = new IndicadorDetalleModel;
    }

    public function guardar()
    {
        $this->indicadorDetalleModel->guardar(['id_indicador' => $_POST['id_indicador'], 'anio_detalle' => $_POST['anio_detalle'], 'resultado_detalle' => $_POST['resultado_detalle'],
        'meta_detalle' => $_POST['meta_detalle'],
        'flag_codefe' => $_POST['flag_codefe']]);
    }

    public function find()
    {
        $this->indicadorDetalleModel->find($_POST['id_indicador_detalle']);
    }

    public function actualizar()
    {
        $this->indicadorDetalleModel->actualizar(['anio_detalle' => $_POST['anio_detalle'], 'resultado_detalle' => $_POST['resultado_detalle'],
        'meta_detalle' => $_POST['meta_detalle'],
        'flag_codefe' => $_POST['flag_codefe']], $_POST['id_detalle_update']);
    }

    public function eliminar()
    {
        $this->indicadorDetalleModel->eliminar($_POST['id_indicador_detalle']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Año</th>
                <th>Resultado</th>
                <th>Meta</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->indicadorDetalleModel->searchTableWhere($this->tabla, 'id_indicador', $_POST['id_indicador']);
        foreach ($result as $r) {
            $data .= '<tr>
            <td align = "center">' . $r->anio_detalle. '</td>
            <td align = "center">'. $r->resultado_detalle. '</td>
            <td align = "center">'. $r->meta_detalle. '</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataIndicadorDetalle(' . $r->id_indicador_detalle . ')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Editar Nombre" onclick="eliminarIndicadorDetalle(' . $r->id_indicador_detalle . ')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
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
}


$indicadorDetalleController = new IndicadorDetalleController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $indicadorDetalleController->$accion();
}
