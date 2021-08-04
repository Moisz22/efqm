<?php

require_once '../models/ProcesoModel.php';

class ProcesoController{

    private $procesoModel;

    public function __construct () {
        $this->procesoModel = new ProcesoModel;
    }

    public function guardarProceso()
    {
        $datoSecuencial = $this->procesoModel->secuencial('proceso', 'id_tipo_proceso', $_POST['tipo_proceso']);
        $secuencial = ($datoSecuencial[0]->secuencial != NULL) ? ($datoSecuencial[0]->secuencial + 1) : '1';
        $this->procesoModel->guardarProceso(['secuencial_proceso' => $secuencial,'descripcion_proceso' => $_POST['nombre_proceso'], 'abreviatura_proceso' => $_POST['abreviatura_proceso'], 'id_tipo_proceso' => $_POST['tipo_proceso'], 'id_propietario_proceso' => $_POST['propietario'], 'id_version_proceso' => $_POST['version'], 'fecha_elaboracion_proceso' => $_POST['fecha_elaboracion'], 'objetivo_proceso' => $_POST['objetivo'], 'alcance_proceso' => $_POST['alcance']]);
    }

    public function find()
    {
        $this->procesoModel->find($_POST['id_proceso']);
    }

    public function actualizar()
    {
        $this->procesoModel->actualizar(['secuencial_proceso' => $_POST['secuencial_proceso'],'descripcion_proceso' => $_POST['nombre_proceso'], 'abreviatura_proceso' => $_POST['abreviatura_proceso'], 'id_tipo_proceso' => $_POST['tipo_proceso'], 'id_propietario_proceso' => $_POST['propietario'], 'id_version_proceso' => $_POST['version'], 'fecha_elaboracion_proceso' => $_POST['fecha_elaboracion'], 'objetivo_proceso' => $_POST['objetivo'], 'alcance_proceso' => $_POST['alcance']], $_POST['id_proceso']);
    }

    public function guardarResponsables()
    {
        $this->procesoModel->guardarResponsables($_POST['id_proceso'], $_POST['responsables']);
    }
    public function guardarIndicadores()
    {
        $this->procesoModel->guardarIndicadores($_POST['id_proceso'], $_POST['indicadores']);
    }
    public function guardarProcesosRelacionados()
    {
        $this->procesoModel->guardarProcesosRelacionados($_POST['id_proceso'], $_POST['procesos_relacionados']);
    }
    public function eliminar()
    {
        $this->procesoModel->eliminar($_POST['id_proceso']);
    }

}


$procesoController = new ProcesoController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $procesoController->$accion();
}