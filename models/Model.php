<?php

require_once '../config/Conexion.php';
/**
 * para usar los metodos de ayuda, se debe especificar el la propiedad $table
 */
class Model{
    /**
     * Con esta propiedad se especifica la tabla que se va a usar para los metodos automaticos
     */
    protected $table = 'frecuencia';
    /**
     * Con esta propiedad se especifica la el campo que se va a usar como id
     */
    protected $keyName = 'id_frecuencia';
    
    /**
     * Con esta propiedad esta la conexion con la base de datos
     */
    protected $db;
    
    public function __construct()
    {
        $this->db = Conexion::getConexion();
    }

    /**
     * Con este metodo se llama a todos los registros disponibles con todos los campos
     */
    public function all()
    {
        $sql = 'select * from ' . $this->table . ' WHERE estado_'.$this->table.' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchTable($tabla)
    {
        $sql = 'select * from ' . $tabla . ' WHERE estado_'.$tabla.' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchTableWhere($tabla, $campo, $valor)
    {
        $sql = 'select * from ' . $tabla . ' WHERE estado_'.$tabla.' = 1 AND '.$campo.' = '.$valor;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function selected($tabla, $campo, $valor)
    {
        $sql = 'select * from ' . $tabla . ' WHERE '.$campo.' = '.$valor;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $seleccionados = $stm->fetchAll();
        return ($seleccionados) ? $seleccionados : false;
    }
    
    public function guardar(array $array)
    {
        $cadena_campos = '';
        $cadena_valores = '';
        $cadena = [];
        $count = 1;

        foreach($array as $campo=>$valor){
 
            $cadena_campos .= $campo.',';
            $cadena_valores .= ':'.$count . ',';
            $cadena[':'.$count] = $valor;
            $count++;
            
        }

        $cadena_campos = rtrim($cadena_campos, ',');
        $cadena_valores = rtrim($cadena_valores, ',');
        
        $sql = 'insert into '. $this->table . '('. $cadena_campos .') values('. $cadena_valores .')';
        $stm = $this->db->prepare($sql);
        $stm->execute( $cadena );
        echo ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

    public function find(int $value)
    {  
        $sql = 'select * from ' . $this->table . ' where ' .$this->keyName. '= :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $value);
        $stm->execute();
        $resultado = $stm->fetchAll();
        echo json_encode($resultado);
    }

    public function actualizar(array $array, string $keyvalue)
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
        
        $sql = 'update ' . $this->table . ' set '. $cadena_campos .' where ' .$this->keyName. ' = ' .$keyvalue;
        $stm = $this->db->prepare($sql);
        echo ($stm->execute($cadena)) ? 'ok' : var_dump($cadena) ;
    }

    public function eliminar(int $value)
    {  
        $sql = 'update ' . $this->table . ' set estado_'.$this->table.' = 0 where ' .$this->keyName. '= :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $value);
        $stm->execute();
        echo ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

    public function destroy($tabla, $campo, $valor)
    {
        $sql = 'delete from ' . $tabla . ' where ' .$campo. ' = :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $valor);
        return ($stm->execute()) ? 'ok' : 'error';
    }

    public function secuencial($tabla, $campo, $valor)
    {
        $sql = 'SELECT MAX(secuencial_'.$tabla.') as secuencial FROM '.$tabla.' WHERE '.$campo.' = :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $valor);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}