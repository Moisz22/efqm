<?php

require_once 'Model.php';

class LoginModel extends Model{

    protected $table = 'usuario';

    protected $keyName = 'id_usuario';

    public function login($usuario, $password)
    {  
        $sql = 'SELECT a.*, CONCAT(b.nombre_persona, " ", b.apellido_persona) as nombres FROM '.$this->table.' as a
        INNER JOIN persona as b ON (a.id_persona = b.id_persona)
        WHERE a.username = :user AND a.password = :password';
        $stm = $this->db->prepare($sql);
        $stm->execute([':user'=>$usuario, ':password'=>$password]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}
