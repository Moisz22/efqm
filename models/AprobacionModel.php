<?php

require_once 'Model.php';

class AprobacionModel extends Model{

    protected $table = 'proceso_aprobacion';

    public function consultaAprobacion($id_proceso)
    {
        $sql = 'select * from ' . $this->table . ' WHERE id_proceso = '.$id_proceso;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}
