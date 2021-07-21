<?php

require_once '../models/AnexoProcesoModel.php';

class AnexoProcesoController{

    private $anexoProcesoModel;
    private $tabla = 'anexo_proceso';

    public function __construct () {
        $this->anexoProcesoModel = new AnexoProcesoModel;
    }

    public function guardar()
    {
        $tipoArchivo = strtolower(pathinfo($_FILES["anexo_proceso"]["name"], PATHINFO_EXTENSION));
      $nuevo_nombre = 'Anexo_proceso_'.$_POST['tipo_documento_anexo'].'_'.$_POST['id_proceso'].'_'.date('dmY_His').'.'.$tipoArchivo;
      if(move_uploaded_file($_FILES['anexo_proceso']['tmp_name'], '../storage/anexo_proceso/' . $nuevo_nombre))
      {
        $this->anexoProcesoModel->guardar(['id_proceso' => $_POST['id_proceso'], 'id_actividad' => $_POST['id_actividad_anexo_proceso'], 'id_tipo_documento' => $_POST['tipo_documento_anexo'], 'descripcion_anexo_proceso' => $_POST['descripcion_anexo_proceso'], 'ruta_anexo_proceso' => $nuevo_nombre]);
      }
      else
        echo 'Error al subir el archivo';
    }

    public function find()
    {
        $this->anexoProcesoModel->find($_POST['id_anexo_proceso']);
    }

    public function actualizar()
    {
        $this->anexoProcesoModel->actualizar(['id_tipo_documento' => $_POST['tipo_documento_anexo_update'], 'id_actividad' => $_POST['id_actividad_anexo_update'], 'descripcion_anexo_proceso' => $_POST['descripcion_anexo_proceso_update']], $_POST['id_anexo_proceso_update']);
    }

    public function eliminar()
    {
        $this->anexoProcesoModel->eliminar($_POST['id_anexo_proceso']);
    }

    public function obtenerTabla()
    {
        $data = '<table class="display_anexo_proceso table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Actividad Asociada</th>
                <th>Tipo de documento</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->anexoProcesoModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<tr>
            <td align = "center">'.$r->descripcion_actividad.'</td>
            <td align = "center">'.$r->descripcion_tipo_documento.'</td>
            <td>'.$r->descripcion_anexo_proceso.'</td>
            <td align = "center">
                <a title="Editar Nombre" onclick="getDataAnexoProceso('.$r->id_anexo_proceso.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                <a title="Ver Archivo" href="../storage/anexo_proceso/'.$r->ruta_anexo_proceso.'" target="_blank" class="btn btn-info"> <i class="far fa-eye"></i></a>
                <a title="Descargar" href="../storage/anexo_proceso/'.$r->ruta_anexo_proceso.'" download="'.$r->descripcion_anexo_proceso.'" class="btn btn-success"> <i class="fa fa-download"></i></a>
                <a title="Editar Nombre" onclick="eliminarAnexoProceso('.$r->id_anexo_proceso.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
            </td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_anexo_proceso").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';

        echo $data;
    }
}


$anexo_procesoController = new AnexoProcesoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $anexo_procesoController->$accion();
}