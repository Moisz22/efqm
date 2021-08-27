<?php

require_once 'Model.php';

class PermisoModel extends Model{

    protected $table = 'permiso';

    protected $keyName = 'id_permiso';

    public function consulta($id_rol)
    {
        $sql = 'select * from '.$this->table.' WHERE id_rol = :value ORDER BY opcion_permiso';
        $stm = $this->db->prepare($sql);
        $stm->execute([':value'=>$id_rol]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}