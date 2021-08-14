<?php

require_once 'Model.php';

class RolModel extends Model{

    protected $table = 'rol';

    protected $keyName = 'id_rol';

    public function guardarRol(array $array)
    {
        $cadena_campos = '';
        $cadena_valores = '';
        $cadena = [];
        $count = 1;

        foreach ($array as $campo => $valor) {

            $cadena_campos .= $campo . ',';
            $cadena_valores .= ':' . $count . ',';
            $cadena[':' . $count] = $valor;
            $count++;
        }

        $cadena_campos = rtrim($cadena_campos, ',');
        $cadena_valores = rtrim($cadena_valores, ',');

        $sql = 'insert into ' . $this->table . '(' . $cadena_campos . ') values(' . $cadena_valores . ')';
        $stm = $this->db->prepare($sql);
        $stm->execute($cadena);
        $id_insertado = $this->db->lastInsertId();
        $sp = 'CALL perfil(:id_rol)';
        $stm_sp = $this->db->prepare($sp);
        $stm_sp->execute([':id_rol'=>$id_insertado]);
        echo ($stm->rowCount() > 0) ? 'ok' : $sql;        
    }
}
