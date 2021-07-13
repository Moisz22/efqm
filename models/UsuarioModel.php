<?php

require_once 'Model.php';

class UsuarioModel extends Model{

    public function guardarRegistro($usuario, $email, $password)
    {
        $sql = 'insert into users(name_user, email_user, password_user) values(:name_user, :email_user, :password_user)';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':name_user', $usuario);
        $stm->bindParam(':email_user', $email);
        $stm->bindParam(':password_user', $password);
        $stm->execute();
        return ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

    public function consultar()
    {   
        $sql = 'select u.id as id_user, u.name_user, u.email_user, u.id_rol, r.nombre_rol from users as u, roles as r where u.estado_user=1 && u.id_rol=r.id';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $resultados = $stm->fetchAll(PDO::FETCH_OBJ);
        return ($resultados) ? $resultados : 'error' ;
    }
    
    public function verificarInicioSesion($usuario, $password)
    {
        $sql = 'select * from users as u, roles as r where u.estado_user=1 && u.name_user=:name_user && u.password_user=:password_user && u.id_rol=r.id';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':name_user', $usuario, PDO::PARAM_STR);
        $stm->bindParam(':password_user', $password, PDO::PARAM_STR);
        $stm->execute();
        $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $resultados = ($resultados) ? $resultados : 'error';
    }

    public function consultarPorCampo($campo, $valor)
    {    
        $sql = 'select * from users as u, roles as r where u.estado_user=1 && u.id_rol=r.id && u.' . $campo .'=:valor';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stm->execute();
        $resultados = $stm->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

}