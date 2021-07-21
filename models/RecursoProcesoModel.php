<?php

require_once 'Model.php';

class RecursoProcesoModel extends Model{

    protected $table = 'recurso_proceso';

    protected $keyName = 'id_recurso_proceso';

    public function consulta($id_proceso)
    {
        $sql = 'select a.*, b.descripcion_actividad, c.descripcion_recurso  from ' . $this->table . ' as a
                INNER JOIN actividad as b ON (a.id_actividad = b.id_actividad)
                INNER JOIN recurso as c ON (a.id_recurso = c.id_recurso)
                WHERE a.estado_'.$this->table.' = 1 AND a.id_proceso = '.$id_proceso.'';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}