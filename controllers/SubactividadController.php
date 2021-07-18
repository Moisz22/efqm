<?php

require_once '../models/SubactividadModel.php';
require_once '../models/ActividadModel.php';

class SubactividadController{

    private $subactividadModel;
    private $actividadModel;

    public function __construct () {
        $this->subactividadModel = new SubactividadModel;
        $this->actividadModel = new ActividadModel;
    }

    /*public function guardar()
    {
        $this->subactividadModel->guardar(['id_proceso' => $_POST['id_proceso'], 'orden_subactividad' => $_POST['orden_subactividad'], 'descripcion_subactividad' => $_POST['de_subactividad']]);
    }

    public function find()
    {
        $this->subactividadModel->find($_POST['id_subactividad']);
    }

    public function actualizar()
    {
        $this->subactividadModel->actualizar(['descripcion_subactividad' => $_POST['descripcion'], 'orden_subactividad' => $_POST['orden']], $_POST['id_subactividad']);
    }

    public function eliminar()
    {
        $this->subactividadModel->eliminar($_POST['id_subactividad']);
    }*/

    public function obtenerAcordeon()
    {
        $data = '';
        $result = $this->actividadModel->consulta($_POST['id_proceso']);
        foreach ($result as $r)
        {
            $data .= '<div class="panel-group" id="accordion">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a  style="color:white;" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$r->id_actividad.'">'.$r->descripcion_actividad.'</a>
                </h4>
              </div>
              <div id="collapse'.$r->id_actividad.'" class="panel-collapse collapse">
                <div class="panel-body">';
                $subactividades = $this->subactividadModel->consulta();
                $data .= '<table class="display_subactividades table table-striped table-bordered" style="width:100%">
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
                    <td>'.$r1->id_responsable.'</td>
                    <td align = "center">
                        <a title="Editar Nombre" onclick="getDataActividad('.$r1->id_subactividad.')" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                        <a title="Agregar subactividades" href="add_detalle.php?id='.$r1->id_subactividad.'" class="btn btn-warning"><i class="fa fa-plus"></i></a>
                        <a title="Editar Nombre" onclick="eliminarActividad('.$r1->id_subactividad.')" class="btn btn-danger"> <i class="fa fa-remove"></i></a>
                    </td>
                </tr>';
                }
                $data .= '
        </tbody>
        </table>';
                $data .= '</div>
              </div>
            </div>
          </div>
          
        ';
        }
        $data .='
        <script>
        $(document).ready(function() {
            $("table.display_subactividades").DataTable( {
                "language": {
                    "url": "../spanish.json"
                }
            } );
        } );
        </script>';
        echo $data;
    }

}


$subactividadController = new SubactividadController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $subactividadController->$accion();
}


/* if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            break;
            
        case 'find':
            break;

        case 'actualizar':
            break;

        case 'eliminar':
            break;
    }
    
}
?> */