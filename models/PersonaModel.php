<?php

require_once 'Model.php';

class PersonaModel extends Model{

    protected $table = 'persona';

    protected $keyName = 'id_persona';

    public function consulta()
    {
        $sql = 'select a.*, b.descripcion_cargo from ' . $this->table . ' as a
                INNER JOIN cargo as b ON (a.id_cargo = b.id_cargo) WHERE a.estado_'.$this->table.' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}