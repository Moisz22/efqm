<?php

require_once 'Model.php';

class IndicadorModel extends Model{

    protected $table = 'indicador';

    protected $keyName = 'id_indicador';

    public function consulta()
    {
        $sql = 'SELECT a.*, b.abreviatura_criterio_efqm, c.descripcion_frecuencia, d.descripcion_categoria_indicador
        FROM `indicador` as a
        INNER JOIN criterio_efqm as b ON (a.id_criterio_efqm = b.id_criterio_efqm)
        INNER JOIN frecuencia as c ON (a.id_frecuencia_indicador = c.id_frecuencia)
        INNER JOIN categoria_indicador as d ON (a.id_categoria_indicador = d.id_categoria_indicador)
        WHERE a.estado_indicador = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function guardarIndicador(array $array)
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
        echo ($stm->rowCount() > 0) ? 'ok_' . $this->db->lastInsertId() : $sql;
    }
}