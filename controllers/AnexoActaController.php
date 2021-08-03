<?php

require_once '../models/AnexoActaModel.php';

class AnexoActaController
{

    private $anexoActaModel;

    public function __construct()
    {
        $this->anexoActaModel = new AnexoActaModel;
    }

    public function guardar()
    {
        $tipoArchivo = strtolower(pathinfo($_FILES["anexo_acta"]["name"], PATHINFO_EXTENSION));
        $nuevo_nombre = 'Anexo_acta_' . $_POST['id_acta'] . '_' . date('dmY_His') . '.' . $tipoArchivo;
        if (move_uploaded_file($_FILES['anexo_acta']['tmp_name'], '../storage/anexo_acta/' . $nuevo_nombre)) {
            $this->anexoActaModel->guardar(['id_acta' => $_POST['id_acta'], 'descripcion_anexo_acta' => $_POST['descripcion_anexo_acta'], 'ruta_anexo_acta' => $nuevo_nombre]);
        } else
            echo 'Error al subir el archivo';
    }

    public function find()
    {
        $this->anexoActaModel->find($_POST['id_anexo_acta']);
    }

    public function actualizar()
    {
        $this->anexoActaModel->actualizar(['descripcion_anexo_acta' => $_POST['descripcion_anexo_acta_update']], $_POST['id_anexo_acta_update']);
    }

    public function eliminar()
    {
        $this->anexoActaModel->eliminar($_POST['id_anexo_acta']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_anexo_acta table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->anexoActaModel->consulta($_POST['id_acta']);
        foreach ($result as $r) {
            $data .= '<tr>
            <td>' . $r->descripcion_anexo_acta . '</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataAnexoActa(' . $r->id_anexo_acta . ')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Ver Archivo" href="../storage/anexo_acta/' . $r->ruta_anexo_acta . '" target="_blank" class="btn btn-info"> <i class="far fa-eye"></i></a>
                <a title="Descargar" href="../storage/anexo_acta/' . $r->ruta_anexo_acta . '" download="' . $r->descripcion_anexo_acta . '" class="btn btn-success"> <i class="fa fa-download"></i></a>
                <a title="Editar Nombre" onclick="eliminarAnexoActa(' . $r->id_anexo_acta . ')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_anexo_acta").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$anexo_actaController = new AnexoActaController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $anexo_actaController->$accion();
}
