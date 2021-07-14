<?php

require_once 'config/Conexion.php';
/**
 * para usar los metodos de ayuda, se debe especificar el la propiedad $table
 */
class Model{

    /**
     * Con esta propiedad se especifica la tabla que se va a usar para los metodos automaticos
     */
    protected $table = 'users';
    /**
     * Con esta propiedad se especifica la el campo que se va a usar como id
     */
    protected $keyName = 'id';
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
        $sql = 'select * from ' . $this->table;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    /**
     * Con este metodo se guarda los datos en la base de datos especificada
     */
    public function save(array $array)
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
        return ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

    /**
     * Con este metodo se encuentra un registro en especifico por su propiedad descrita en keyName
     */
    public function find(int $value)
    {  
        $sql = 'select * from ' . $this->table . ' where ' .$this->keyName. '= :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $value);
        $stm->execute();
        $resultado = $stm->fetchAll();
        return ($resultado);
    }
    
    /**
     * Con este metodo se elimina un registro por su propiedad asignada en keyName
     */
    public function destroy(int $value)
    {
        $sql = 'delete from ' . $this->table . ' where ' .$this->keyName. ' = :value';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':value', $value);
        $stm->execute();
        return ($stm->rowCount()>0) ? 'ok' : 'error';
    }

    /**
     * Con este metodo se actualiza un registro segun la propiedad puesta en keyName
     */
    public function update(array $array, string $keyvalue)
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
        $stm->execute($cadena);
        return ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

}