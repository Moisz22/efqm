<?php

require_once '../models/ParametroModel.php';
require_once '../models/UsuarioModel.php';

class ParametroController
{

    private $parametroModel;
    private $usuarioModel;

    public function __construct()
    {
        $this->parametroModel = new ParametroModel;
        $this->usuarioModel = new UsuarioModel;
    }

    public function subirMisionVision()
    {
        $allowedFileType = ['application/pdf'];
        if (in_array($_FILES["mision_vision"]["type"], $allowedFileType)) {
            $tipoArchivo = strtolower(pathinfo($_FILES["mision_vision"]["name"], PATHINFO_EXTENSION));
            $nuevo_nombre = 'Mision_vision' . '_' . date('dmY_His') . '.' . $tipoArchivo;
            if (move_uploaded_file($_FILES['mision_vision']['tmp_name'], '../storage/mision_vision/' . $nuevo_nombre)) {
                $this->parametroModel->actualizarParametro(['ruta_vision_mision' => $nuevo_nombre]);
            } else
                echo 'Error al subir el archivo';
        } else
            echo 'Debe ser un archivo en formato PDF';
    }

    public function subirOrgranigrama()
    {
        $tipoArchivo = strtolower(pathinfo($_FILES["organigrama"]["name"], PATHINFO_EXTENSION));
        if ($tipoArchivo == 'jpg' || $tipoArchivo == 'png') {
            $nuevo_nombre = 'Organigrama' . '_' . date('dmY_His') . '.' . $tipoArchivo;
            if (move_uploaded_file($_FILES['organigrama']['tmp_name'], '../storage/organigrama/' . $nuevo_nombre)) {
                $this->parametroModel->actualizarParametro(['ruta_organigrama' => $nuevo_nombre]);
            } else
                echo 'Error al subir el archivo';
        } else
            echo 'Debe ser en formato jpg o png';
    }

    public function activaUsuario()
    {
        $this->usuarioModel->actualizar(['acceso_usuario' => $_POST['acceso']], $_POST['id_usuario']);
    }
}
$ParametroController = new ParametroController;


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $accion = $_POST['action'];
    $ParametroController->$accion();
}
