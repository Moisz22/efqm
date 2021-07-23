<?php

require_once 'Model.php';

class SubactividadModel extends Model{

    protected $table = 'subactividad';

    protected $keyName = 'id_subactividad';

    public function consulta($id_actividad)
    {
        $sql = 'select a.*, b.descripcion_cargo from ' . $this->table . ' as a
                INNER JOIN cargo as b ON (a.id_responsable = b.id_cargo)
                WHERE a.estado_'.$this->table.' = 1
                AND id_actividad = '.$id_actividad.'
                ORDER BY orden_subactividad';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}