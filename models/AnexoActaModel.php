<?php

require_once 'Model.php';

class AnexoActaModel extends Model{

    protected $table = 'anexo_acta';

    protected $keyName = 'id_anexo_acta';

    public function consulta($id_acta)
    {
        $sql = 'select * from ' . $this->table . '
                WHERE estado_'.$this->table.' = 1 AND id_acta = '.$id_acta.'';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}