<?php

require_once '../models/SubactividadModel.php';
require_once '../models/ActividadModel.php';

class SubactividadController{

    private $subactividadModel;
    private $actividadModel;

    public function __construct () {
        $this->rModel = new Model;
        $this->subactividadModel = new SubactividadModel;
        $this->actividadModel = new ActividadModel;
    }

    public function guardar()
    {
        $this->subactividadModel->guardar(['id_actividad' => $_POST['id_actividad_subactividad'], 'descripcion_subactividad' => $_POST['descripcion_subactividad'], 'orden_subactividad' => $_POST['orden_subactividad'], 'id_responsable ' => $_POST['id_responsable_subactividad']]);
    }

    public function find()
    {
        $this->subactividadModel->find($_POST['id_subactividad']);
    }

    public function actualizar()
    {
        $this->subactividadModel->actualizar(['id_actividad' => $_POST['id_actividad_subactividad'], 'descripcion_subactividad' => $_POST['descripcion_subactividad'], 'orden_subactividad' => $_POST['orden_subactividad'], 'id_responsable ' => $_POST['id_responsable_subactividad']], $_POST['id_subactividad']);
    }

    public function eliminar()
    {
        $this->subactividadModel->eliminar($_POST['id_subactividad']);
    }

    public function obtenerTablaSubactividad($id_actividad = NULL)
    {
        $id_actividad = (isset($_POST['id_actividad'])) ? $_POST['id_actividad'] : $id_actividad;
        $subactividades = $this->subactividadModel->consulta($id_actividad);
                $data = '<table class="display_subactividades_'.$id_actividad.' table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Descripción</th>
                        <th>Responsable</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($subactividades as $r1)
                {
                    $data .= '<tr>
                    <td align = "center">'.$r1->orden_subactividad.'</td>
                    <td>'.$r1->descripcion_subactividad.'</td>
                    <td>'.$r1->descripcion_cargo.'</td>
                    <td align = "center">
                        <a title="Editar" onclick="getDataSubactividad('.$r1->id_subactividad.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                        <a title="Eliminar" onclick="eliminarSubactividad('.$id_actividad.','.$r1->id_subactividad.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
                    </td>
                </tr>';
                }
                $data .= '
        </tbody>
        </table>';
        $data .='
        <script>
        $(document).ready(function() {
            $("table.display_subactividades_'.$id_actividad.'").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';
        if (isset($_POST['id_actividad']))
        {
            echo $data;
        }
        else
            return $data;
    }

    public function obtenerAcordeon()
    {
        $data = '';
        $result = $this->actividadModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<div class="panel-group" id="accordion">
            <div class="panel panel-primary">
              <div class="panel-heading pointer"  data-toggle="collapse" data-parent="#accordion" href="#collapse'.$r->id_actividad.'" >
                <h4 class="panel-title">
                  <a  style="color:white; width: 100%; ">'.$r->descripcion_actividad.'</a>
                </h4>
              </div>
              <div id="collapse'.$r->id_actividad.'" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="record_subactividad_'.$r->id_actividad.'">';
                $data .= $this->obtenerTablaSubactividad($r->id_actividad);
                $data .=' </div>
                </div>
              </div>
            </div>
          </div>
          
        ';
        }
        echo $data;
    }

   

}


$subactividadController = new SubactividadController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $subactividadController->$accion();
}