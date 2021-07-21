<?php

require_once 'Model.php';

class AnexoProcesoModel extends Model{

    protected $table = 'anexo_proceso';

    protected $keyName = 'id_anexo_proceso';

    public function consulta($id_proceso)
    {
        $sql = 'select a.*, b.descripcion_actividad, c.descripcion_tipo_documento  from ' . $this->table . ' as a
                INNER JOIN actividad as b ON (a.id_actividad = b.id_actividad)
                INNER JOIN tipo_documento as c ON (a.id_tipo_documento = c.id_tipo_documento)
                WHERE a.estado_'.$this->table.' = 1 AND a.id_proceso = '.$id_proceso.'';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}