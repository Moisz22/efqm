<?php

require_once '../models/ActaModel.php';

class ActaController
{

    private $actaModel;

    public function __construct()
    {
        $this->actaModel = new ActaModel;
    }

    public function guardarActa()
    {
        $datoSecuencial = $this->actaModel->secuencial('acta', 'id_equipo_trabajo', $_POST['equipo_trabajo']);
        $secuencial = ($datoSecuencial[0]->secuencial != NULL) ? ($datoSecuencial[0]->secuencial + 1) : '1';
        $this->actaModel->guardarActa(['secuencial_acta' => $secuencial, 'fecha_acta' => $_POST['fecha_acta'], 'hora_inicio_acta' => $_POST['hora_inicio_acta'], 'id_lugar' => $_POST['lugar'], 'hora_finalizacion_acta' => $_POST['hora_finalizacion_acta'], 'orden_acta' => $_POST['orden_acta'], 'id_equipo_trabajo' => $_POST['equipo_trabajo'], 'bitacora_aprendizaje_acta' => $_POST['bitacora_aprendizaje_acta'], 'desarrollo_acta' => $_POST['desarrollo_acta']]);
    }

    public function guardaInvitados()
    {
        $this->actaModel->guardaInvitados($_POST['id_acta'], $_POST['invitados']);
    }

    public function guardaAsistencia()
    {
        $this->actaModel->guardaAsistencia($_POST['id_acta'], $_POST['miembros'], $_POST['asistencia']);
    }

    public function find()
    {
        $this->actaModel->find($_POST['id_acta']);
    }

    public function actualizar()
    {
        $this->actaModel->destroy('acta_asistentes', 'id_acta', $_POST['id_acta']);
        $this->actaModel->actualizar(['secuencial_acta' => $_POST['secuencial_acta'], 'fecha_acta' => $_POST['fecha_acta'], 'hora_inicio_acta' => $_POST['hora_inicio_acta'], 'id_lugar' => $_POST['lugar'], 'hora_finalizacion_acta' => $_POST['hora_finalizacion_acta'], 'orden_acta' => $_POST['orden_acta'], 'id_equipo_trabajo' => $_POST['equipo_trabajo'], 'bitacora_aprendizaje_acta' => $_POST['bitacora_aprendizaje_acta'], 'desarrollo_acta' => $_POST['desarrollo_acta']], $_POST['id_acta']);
    }

    public function eliminar()
    {
        $this->actaModel->eliminar($_POST['id_acta']);
    }

    public function obtenerTabla()
    {
        $flag = $_POST['flag'];

        $data = '<table class="display table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Miembro Equipo</th>
                <th>Asistencia</th>
            </tr>
        </thead>
        <tbody>';
        $result = $this->actaModel->consultaMiembrosEquipo($_POST['id_equipo']);
        foreach ($result as $r) {
            if ($flag > 0) {
                $datoAsistencia = $this->actaModel->asistenciaMiembro($flag, $r->id_persona);
                if ($datoAsistencia != false) {
                    if ($datoAsistencia[0]->fl_asistencia == 1)
                        $checked = 'checked';
                    else
                        $checked = '';
                } else
                    $checked = '';
            } else
                $checked = '';

            $data .= '<tr>
            <td align = "center"><input type = "hidden" name="id_miembro_equipo" id="id_miembro_equipo" value= ' . $r->id_persona . '>' . $r->descripcion_persona . '</td>
            <td align = "center"><input type ="checkbox" ' . $checked . ' name="chk_asistencia" id="chk_asistencia" value="1"></td>
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

    public function convertirFechaLetra($numero)
    {
        switch ($numero) {
            case 0:
                $letras = 'cero';
                break;
            case 1:
                $letras = 'un';
                break;
            case 2:
                $letras = 'dos';
                break;
            case 3:
                $letras = 'tres';
                break;
            case 4:
                $letras = 'cuatro';
                break;
            case 5:
                $letras = 'cinco';
                break;
            case 6:
                $letras = 'seis';
                break;
            case 7:
                $letras = 'siete';
                break;
            case 8:
                $letras = 'ocho';
                break;
            case 9:
                $letras = 'nueve';
                break;
            case 10:
                $letras = 'diez';
                break;
            case 11:
                $letras = 'once';
                break;
            case 12:
                $letras = 'doce';
                break;
            case 13:
                $letras = 'trece';
                break;
            case 14:
                $letras = 'catorce';
                break;
            case 15:
                $letras = 'quince';
                break;
            case 16:
                $letras = 'dieciseis';
                break;
            case 17:
                $letras = 'diecisiete';
                break;
            case 18:
                $letras = 'dieciocho';
                break;
            case 19:
                $letras = 'diecinueve';
                break;
            case 20:
                $letras = 'veinte';
                break;
            case 21:
                $letras = 'veintiun';
                break;
            case 22:
                $letras = 'veintidos';
                break;
            case 23:
                $letras = 'veintitres';
                break;
            case 24:
                $letras = 'veinticuatro';
                break;
            case 25:
                $letras = 'veinticinco';
                break;
            case 26:
                $letras = 'veintiseis';
                break;
            case 27:
                $letras = 'veintisiete';
                break;
            case 28:
                $letras = 'veintiocho';
                break;
            case 29:
                $letras = 'veintinueve';
                break;
            case 30:
                $letras = 'treinta';
                break;
            case 31:
                $letras = 'treinta y un';
                break;
            case 32:
                $letras = 'treinta y dos';
                break;
            case 33:
                $letras = 'treinta y tres';
                break;
            case 34:
                $letras = 'treinta y cuatro';
                break;
            case 35:
                $letras = 'treinta y cinco';
                break;
            case 36:
                $letras = 'treinta y seis';
                break;
            case 37:
                $letras = 'treinta y siete';
                break;
            case 38:
                $letras = 'treinta y ocho';
                break;
            case 39:
                $letras = 'treinta y nueve';
                break;
            case 40:
                $letras = 'cuarenta';
                break;
            case 41:
                $letras = 'cuarenta y un';
                break;
            case 42:
                $letras = 'cuarenta y dos';
                break;
            case 43:
                $letras = 'cuarenta y tres';
                break;
            case 44:
                $letras = 'cuarenta y cuatro';
                break;
            case 45:
                $letras = 'cuarenta y cinco';
                break;
            case 46:
                $letras = 'cuarenta y seis';
                break;
            case 47:
                $letras = 'cuarenta y siete';
                break;
            case 48:
                $letras = 'cuarenta y ocho';
                break;
            case 49:
                $letras = 'cuarenta y nueve';
                break;
            case 50:
                $letras = 'cincuenta';
                break;
            case 51:
                $letras = 'cincuenta y un';
                break;
            case 52:
                $letras = 'cincuenta y dos';
                break;
            case 53:
                $letras = 'cincuenta y tres';
                break;
            case 54:
                $letras = 'cincuenta y cuatro';
                break;
            case 55:
                $letras = 'cincuenta y cinco';
                break;
            case 56:
                $letras = 'cincuenta y seis';
                break;
            case 57:
                $letras = 'cincuenta y siete';
                break;
            case 58:
                $letras = 'cincuenta y ocho';
                break;
            case 59:
                $letras = 'cincuenta y nueve';
                break;
            case 60:
                $letras = 'sesenta';
                break;
            case 2018:
                $letras = 'dos mil dieciocho';
                break;
            case 2019:
                $letras = 'dos mil diecinueve';
                break;
            case 2020:
                $letras = 'dos mil veinte';
                break;
            case 2021:
                $letras = 'dos mil veintiuno';
                break;
            case 2022:
                $letras = 'dos mil veintidos';
                break;
            case 2023:
                $letras = 'dos mil veintitres';
                break;
            default:
                $letras = '';
                break;
        }
        return $letras;
    }
}


$actaController = new ActaController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $actaController->$accion();
}
