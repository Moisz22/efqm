<?php

require_once '../models/PermisoModel.php';

class PermisoController
{

    private $permisoModel;
    private $tabla = 'permiso';

    public function __construct()
    {
        $this->permisoModel = new PermisoModel;
    }

    public function cargaPermiso()
    {
        $data = '<table class="display_permiso table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nombre permiso</th>    
                <th>Acceso</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->permisoModel->consulta($_POST['id_rol']);
        $opciones = ['', 'Dashboard', 'Recursos', 'Versión', 'Cargos', 'Tipos de proceso', 'Frecuencia', 'Criterio EFQM', 'Categoria indicador', 'Tipo de documento', 'Lugares', 'Personas', 'Equipos de trabajo', 'Procesos', 'Indicadores', 'Actas de equipo', 'Reporte por tipo de proceso', 'Inasistencia', 'Gráficos de indicadores', 'Usuarios', 'Roles', 'Permisos', 'Parámetros', 'Aprobación de ficha de procesos'];
        foreach ($result as $r) {
            $checked = ($r->flag_permiso == 1) ? 'checked' : '';
            $data .= '<tr>
            <td align = "center">' . $opciones[$r->opcion_permiso] . '</td>
            <td align = "center"><input type="checkbox" ' . $checked . ' id="check_' . $r->id_permiso . '" name="check_' . $r->id_permiso . '" onchange="asignaPermiso(' . $r->id_permiso . ')" value="1"></td>
        </tr>';
        }
        $data .= '
        </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("table.display_permiso").DataTable( {
                "language": {
                    "url": "../spanish.json"
                },
                ordering: false
            } );
        } );
        </script>';

        echo $data;
    }

    public function asignaPermiso()
    {
        $this->permisoModel->actualizar(['flag_permiso' => $_POST['permiso']], $_POST['id_permiso']);
    }
}


$permisoController = new PermisoController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $permisoController->$accion();
}
