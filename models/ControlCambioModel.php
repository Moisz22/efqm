<?php

require_once 'Model.php';

class ControlCambioModel extends Model{

    protected $table = 'control_cambio';

    protected $keyName = 'id_control_cambio';

    public function consulta($id_proceso)
    {
        $sql = 'select a.*, b.descripcion_version from ' . $this->table . ' as a,
        version as b WHERE a.estado_'.$this->table . ' = 1 AND a.id_proceso = '.$id_proceso.' AND a.id_version=b.id_version ORDER BY a.descripcion_'. $this->table ;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}