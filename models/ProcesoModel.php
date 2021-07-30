<?php

require_once 'Model.php';

class ProcesoModel extends Model
{

    protected $table = 'proceso';

    protected $keyName = 'id_proceso';

    public function consulta()
    {
        $sql = 'select a.*, b.descripcion_cargo, c.descripcion_tipo_proceso from ' . $this->table . ' as a
                INNER JOIN cargo as b ON (a.id_propietario_proceso = b.id_cargo)
                INNER JOIN tipo_proceso as c ON (a.id_tipo_proceso = c.id_tipo_proceso)
                WHERE a.estado_' . $this->table . ' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function guardarProceso(array $array)
    {
        $cadena_campos = '';
        $cadena_valores = '';
        $cadena = [];
        $count = 1;

        foreach ($array as $campo => $valor) {

            $cadena_campos .= $campo . ',';
            $cadena_valores .= ':' . $count . ',';
            $cadena[':' . $count] = $valor;
            $count++;
        }

        $cadena_campos = rtrim($cadena_campos, ',');
        $cadena_valores = rtrim($cadena_valores, ',');

        $sql = 'insert into ' . $this->table . '(' . $cadena_campos . ') values(' . $cadena_valores . ')';
        $stm = $this->db->prepare($sql);
        $stm->execute($cadena);
        echo ($stm->rowCount() > 0) ? 'ok_' . $this->db->lastInsertId() : 'error';
    }

    public function guardarIndicadores($id_proceso, $array)
    {
        $validacion = $this->destroy('proceso_indicador', 'id_proceso', $id_proceso);
        if ($validacion == 'ok') {
            $indicador = json_decode($array);
            for ($i = 0; $i < sizeof($indicador); $i++) {
                $sql = 'insert into proceso_indicador (id_proceso, id_indicador) values(?, ?)';
                $stm = $this->db->prepare($sql);
                $stm->execute([$id_proceso, $indicador[$i]]);
            }
            echo ($stm->rowCount() > 0) ? 'ok' : 'error';
        }
        else
            echo $validacion;
    }
    public function guardarResponsables($id_proceso, $array)
    {
        $validacion = $this->destroy('responsable_proceso', 'id_proceso', $id_proceso);
        if ($validacion == 'ok') {
            $responsable = json_decode($array);
            for ($i = 0; $i < sizeof($responsable); $i++) {
                $sql = 'insert into responsable_proceso (id_cargo, id_proceso) values(?, ?)';
                $stm = $this->db->prepare($sql);
                $stm->execute([$responsable[$i], $id_proceso]);
            }
            echo ($stm->rowCount() > 0) ? 'ok' : 'error';
        }
        else
            echo $validacion;
    }
    public function guardarProcesosRelacionados($id_proceso, $array)
    {
        $validacion = $this->destroy('proceso_relacionado', 'id_proceso', $id_proceso);
        if ($validacion == 'ok') {
            $proceso_relacionado = json_decode($array);
            for ($i = 0; $i < sizeof($proceso_relacionado); $i++) {
                $sql = 'insert into proceso_relacionado (id_proceso, id_proceso_relacionado) values(?, ?)';
                $stm = $this->db->prepare($sql);
                $stm->execute([$id_proceso, $proceso_relacionado[$i]]);
            }
            echo ($stm->rowCount() > 0) ? 'ok' : 'error';
        }
        else
            echo $validacion;
    }
}

$ProcesoModel = new ProcesoModel();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'guardarProceso':
            $ProcesoModel->$action(['descripcion_proceso' => $_POST['nombre_proceso'], 'abreviatura_proceso' => $_POST['abreviatura_proceso'], 'id_tipo_proceso' => $_POST['tipo_proceso'], 'id_propietario_proceso' => $_POST['propietario'], 'id_version_proceso' => $_POST['version'], 'fecha_elaboracion_proceso' => $_POST['fecha_elaboracion'], 'objetivo_proceso' => $_POST['objetivo'], 'alcance_proceso' => $_POST['alcance']]);
            break;
        case 'actualizar':
            $ProcesoModel->$action(['descripcion_proceso' => $_POST['nombre_proceso'], 'abreviatura_proceso' => $_POST['abreviatura_proceso'], 'id_tipo_proceso' => $_POST['tipo_proceso'], 'id_propietario_proceso' => $_POST['propietario'], 'id_version_proceso' => $_POST['version'], 'fecha_elaboracion_proceso' => $_POST['fecha_elaboracion'], 'objetivo_proceso' => $_POST['objetivo'], 'alcance_proceso' => $_POST['alcance']], $_POST['id_proceso']);
            break;
        case 'guardarResponsables':
            $ProcesoModel->$action($_POST['id_proceso'], $_POST['responsables']);
            break;
        case 'guardarIndicadores':
            $ProcesoModel->$action($_POST['id_proceso'], $_POST['indicadores']);
            break;
        case 'guardarProcesosRelacionados':
            $ProcesoModel->$action($_POST['id_proceso'], $_POST['procesos_relacionados']);
            break;
        case 'find':
            $ProcesoModel->$action($_POST['id_proceso']);
            break;

        case 'actualizar':
            $ProcesoModel->$action(['descripcion_proceso' => $_POST['descripcion'], 'jefe_proceso' => $_POST['jefe_proceso']], $_POST['id_proceso']);
            break;

        case 'eliminar':
            $ProcesoModel->$action($_POST['id_proceso']);
            break;
    }
}
