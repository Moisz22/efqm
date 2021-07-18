<?php

require_once 'Model.php';

class ActividadModel extends Model{

    protected $table = 'actividad';

    protected $keyName = 'id_actividad';

    public function consulta($id_proceso)
    {
        $sql = 'select * from ' . $this->table . '
                WHERE estado_'.$this->table.' = 1 AND id_proceso = '.$id_proceso.' ORDER BY orden_actividad';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}