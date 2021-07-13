<?php

require_once 'Model.php';

class RecursoModel extends Model{

    public function guardar(string $nombre_recurso)
    {
        $sql = 'insert into recurso(descripcion_recurso) values(:nombre_recurso)';
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':nombre_recurso', $nombre_recurso);
        $stm->execute();
        echo ($stm->rowCount() > 0) ? 'ok' : 'error' ;
    }

}

$recursoModel = new RecursoModel();
if(isset($_POST['action'])&& isset($_POST['descripcion']))
{
    $action = $_POST['action'];
    $recursoModel->$action($_POST['descripcion']);
}