<?php

require_once 'Model.php';

class DashboardModel extends Model{

    public function graficoProceso()
    {  
        $sql = 'SELECT COUNT(id_proceso) as cuenta, b.descripcion_tipo_proceso as label  FROM proceso as a
        INNER JOIN tipo_proceso as b ON (a.id_tipo_proceso = b.id_tipo_proceso) 
        WHERE a.estado_proceso = 1 AND b.estado_tipo_proceso = 1
        GROUP BY b.descripcion_tipo_proceso';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();
        echo json_encode($resultado);
    }
}
