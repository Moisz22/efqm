<?php

require_once 'Model.php';

class UsuarioModel extends Model{

    protected $table = 'usuario';

    protected $keyName = 'id_usuario';

    public function consulta()
    {
        $sql = 'select a.*, CONCAT(b.nombre_persona, " ", b.apellido_persona) as persona, c.descripcion_rol  from ' . $this->table . ' as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        INNER JOIN rol as c ON (a.id_rol = c.id_rol)
        WHERE a.estado_'.$this->table.' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}