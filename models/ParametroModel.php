<?php

require_once 'Model.php';

class ParametroModel extends Model{

    protected $table = 'parametro';

    public function actualizarParametro(array $array)
    {
        $cadena_campos = '';
        $cadena = [];
        $count = 1;

        foreach($array as $campo=>$valor)
        {
            $cadena_campos .= $campo.'=?,';
            array_push($cadena, $valor);
            $count++;     
        }

        $cadena_campos = rtrim($cadena_campos, ',');
        
        $sql = 'update ' . $this->table . ' set '. $cadena_campos;
        $stm = $this->db->prepare($sql);
        echo ($stm->execute($cadena)) ? 'ok' : var_dump($cadena) ;
    }
    public function cargaParametros()
    {
        $sql = 'select * from ' . $this->table;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}