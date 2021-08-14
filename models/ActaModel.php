<?php

require_once 'Model.php';

class ActaModel extends Model
{

    protected $table = 'acta';

    protected $keyName = 'id_acta';

    public function consulta()
    {
        $sql = 'SELECT a.*, b.descripcion_equipo_trabajo
        FROM ' . $this->table . ' as a 
        INNER JOIN equipo_trabajo as b ON (a.id_equipo_trabajo = b.id_equipo_trabajo)
        WHERE estado_' . $this->table . ' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultaMiembrosEquipo(int $id_equipo)
    {
        $sql = "SELECT a.*, CONCAT(b.nombre_persona,' ',b.apellido_persona) as descripcion_persona, b.impresion_persona
        FROM `usuario` as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        WHERE equipo_usuario = $id_equipo";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultaAsistentes(int $id_acta)
    {
        $sql = "SELECT a.*, CONCAT(b.nombre_persona,' ',b.apellido_persona) as descripcion_persona, b.impresion_persona, c.descripcion_cargo
        FROM `acta_asistentes` as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        INNER JOIN cargo as c ON (b.id_cargo = c.id_cargo)
        WHERE a.id_acta = $id_acta ORDER BY es_miembro_equipo DESC";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    public function guardarActa(array $array)
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
        $id_insertado = $this->db->lastInsertId();
        echo ($stm->rowCount() > 0) ? 'ok_'.$id_insertado : $sql;        
    }

    public function selectedPersona($id_acta, $flag)
    {
        $sql = 'select * from acta_asistentes WHERE id_acta = '.$id_acta.' and es_miembro_equipo = '.$flag;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $seleccionados = $stm->fetchAll();
        return ($seleccionados) ? $seleccionados : false;
    }

    public function asistenciaMiembro($id_acta, $id_miembro)
    {
        $sql = 'select * from acta_asistentes WHERE id_acta = '.$id_acta.' and id_persona = '.$id_miembro;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $asistentes = $stm->fetchAll(PDO::FETCH_OBJ);
        return ($asistentes) ? $asistentes : false;
    }

    public function guardaInvitados($id_acta, $array)
    {
        $invitado = json_decode($array);
        for ($i = 0; $i < sizeof($invitado); $i++) {
            $sql = 'insert into acta_asistentes (`id_acta`, `id_persona`, `es_miembro_equipo`, `fl_asistencia`) values(?, ?, ?, ?)';
            $stm = $this->db->prepare($sql);
            $stm->execute([$id_acta, $invitado[$i], '0', '1']);
        }
        echo ($stm->rowCount() > 0) ? 'ok' : 'error';
    }

    public function guardaAsistencia($id_acta, $array_miembros, $array_asistencia)
    {
        $miembros = json_decode($array_miembros);
        $asistencia = json_decode($array_asistencia);
        for ($i = 0; $i < sizeof($miembros); $i++) {
            $sql = 'insert into acta_asistentes (`id_acta`, `id_persona`, `es_miembro_equipo`, `fl_asistencia`) values(?, ?, ?, ?)';
            $stm = $this->db->prepare($sql);
            $stm->execute([$id_acta, $miembros[$i], '1', $asistencia[$i]]);
        }
        echo ($stm->rowCount() > 0) ? 'ok' : 'error';
    }

    public function datosActa($id_acta)
    {
        $sql = 'SELECT a.*, b.descripcion_equipo_trabajo, c.descripcion_lugar
        FROM `acta`as a
        INNER JOIN equipo_trabajo as b ON (a.id_equipo_trabajo = b.id_equipo_trabajo)
        INNER JOIN lugar as c ON (a.id_lugar = c.id_lugar)
        WHERE id_acta = '.$id_acta.' AND estado_acta = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function inasistentesPorFecha($fecha_desde, $fecha_hasta)
    {
        $sql = "SELECT DISTINCT a.id_persona, CONCAT(b.nombre_persona, ' ', b.apellido_persona) as descripcion_persona, e.descripcion_equipo_trabajo
        FROM `acta_asistentes` as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        INNER JOIN acta as c ON (a.id_acta = c.id_acta)
        INNER JOIN usuario as d ON (a.id_persona = d.id_persona)
        INNER JOIN equipo_trabajo as e ON (d.equipo_usuario = e.id_equipo_trabajo)
        WHERE (((c.fecha_acta)>=:fecha_desde
        AND c.estado_acta != 0
        AND (c.fecha_acta)<=:fecha_hasta)
        AND (a.fl_asistencia)=0) ORDER BY e.descripcion_equipo_trabajo";
        $stm = $this->db->prepare($sql);
        $stm->execute([':fecha_desde'=>$fecha_desde, ':fecha_hasta'=>$fecha_hasta]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function inasistencia($id_persona, $fecha_desde, $fecha_hasta)
    {
        $sql = "SELECT c.id_acta, c.fecha_acta
        FROM `acta_asistentes` as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        INNER JOIN acta as c ON (a.id_acta = c.id_acta)
        WHERE (((c.fecha_acta)>=:fecha_desde
        AND c.estado_acta != 0
        AND (c.fecha_acta)<=:fecha_hasta)
        AND (a.fl_asistencia)=0
        AND a.id_persona= :id_persona)";
        $stm = $this->db->prepare($sql);
        $stm->execute([':fecha_desde'=>$fecha_desde, ':fecha_hasta'=>$fecha_hasta, ':id_persona'=>$id_persona]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}
