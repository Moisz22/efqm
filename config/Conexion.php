<?php 

require_once 'config.php';

class Conexion{

    public static function getConexion(){

        $dsn = 'mysql:host=' . SERVIDORBD . ';dbname=' . NOMBREBD . ';port=' . PUERTO;
        $conexion = null; 

        try{

            $conexion = new PDO($dsn, USUARIO, PASSWORD); 
               
        }catch(Exception $e){

            /* echo $e; */
            die("error " . $e->getMessage());

        }

        return $conexion;
    }
}

