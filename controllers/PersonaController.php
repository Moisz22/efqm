<?php

require_once '../models/PersonaModel.php';

class PersonaController{

    private $personaModel;

    public function __construct () {
        $this->personaModel = new PersonaModel;
    }

    public function guardar()
    {
        $this->personaModel->guardar(['dni_persona' => $_POST['identificacion_persona'], 'nombre_persona' => $_POST['nombre_persona'], 'apellido_persona' => $_POST['apellido_persona'], 'impresion_persona' => $_POST['impresion_persona'], 'id_cargo' => $_POST['id_cargo'], 'flag_empleado' => $_POST['flag_empleado'] ]);
    }

    public function find()
    {
        $this->personaModel->find($_POST['id_persona']);
    }

    public function actualizar()
    {
        $this->personaModel->actualizar(['dni_persona' => $_POST['identificacion_persona'], 'nombre_persona' => $_POST['nombre_persona'], 'apellido_persona' => $_POST['apellido_persona'], 'impresion_persona' => $_POST['impresion_persona'], 'id_cargo' => $_POST['id_cargo'], 'flag_empleado' => $_POST['flag_empleado'] ], $_POST['id_persona']);
    }

    public function eliminar()
    {
        $this->personaModel->eliminar($_POST['id_persona']);
    }
}


$personaController = new PersonaController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $personaController->$accion();
}