<?php

require_once '../config/Conexion.php';
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
    public function all($table)
    {
        $sql = 'select * from ' . $table;
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}