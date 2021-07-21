<?php

require_once 'Model.php';

class PoliticaModel extends Model{

    protected $table = 'politica';

    protected $keyName = 'id_politica';

    public function consulta($id_proceso)
    {
        $sql = 'select a.*, b.descripcion_actividad  from ' . $this->table . ' as a
                INNER JOIN actividad as b ON (a.id_actividad = b.id_actividad)
                WHERE a.estado_'.$this->table.' = 1 AND a.id_proceso = '.$id_proceso.'';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}