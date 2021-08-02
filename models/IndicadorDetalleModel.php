<?php

require_once 'Model.php';

class IndicadorDetalleModel extends Model{

    protected $table = 'indicador_detalle';

    protected $keyName = 'id_indicador_detalle';

    public function obtenerDetalle(int $id_indicador)
    {  
        $sql = 'select * from ' . $this->table . ' where id_indicador = :value order by anio_detalle, flag_codefe';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $id_indicador);
        $stm->execute();
        $resultado = $stm->fetchAll();
        echo json_encode($resultado);
    }
}
