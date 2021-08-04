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

    public function datosProceso($id_proceso)
    {
        $sql = 'SELECT a.*, b.abreviatura_tipo_proceso, c.descripcion_version as version, d.descripcion_cargo as propietario
        FROM proceso as a
        INNER JOIN tipo_proceso as b ON (a.id_tipo_proceso = b.id_tipo_proceso)
        INNER JOIN version as c ON (a.id_version_proceso = c.id_version)
        INNER JOIN cargo as d ON (a.id_propietario_proceso = d.id_cargo)
        WHERE a.id_proceso = '.$id_proceso.' AND a.estado_proceso = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultaProcesoPorTipo($id_tipo_proceso)
    {
        $sql = 'SELECT a.*, b.abreviatura_tipo_proceso, c.descripcion_version as version, d.descripcion_cargo as propietario
        FROM '.$this->table.' as a
        INNER JOIN tipo_proceso as b ON (a.id_tipo_proceso = b.id_tipo_proceso)
        INNER JOIN version as c ON (a.id_version_proceso = c.id_version)
        INNER JOIN cargo as d ON (a.id_propietario_proceso = d.id_cargo)
        WHERE a.estado_'.$this->table. ' = 1 and a.id_tipo_proceso = :value ORDER BY a.secuencial_proceso';
        $stm = $this->db->prepare($sql);
        $stm->execute([':value'=>$id_tipo_proceso]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}
