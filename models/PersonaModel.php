<?php

require_once 'Model.php';

class PersonaModel extends Model{

    protected $table = 'persona';

    protected $keyName = 'id_persona';

    public function consulta()
    {
        $sql = 'select a.*, b.descripcion_cargo from ' . $this->table . ' as a
                INNER JOIN cargo as b ON (a.id_cargo = b.id_cargo) WHERE a.estado_'.$this->table.' = 1';
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}

$PersonaModel = new PersonaModel();

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case 'guardar':
            $PersonaModel->$action(['dni_persona' => $_POST['identificacion_persona'], 'nombre_persona' => $_POST['nombre_persona'], 'apellido_persona' => $_POST['apellido_persona'], 'impresion_persona' => $_POST['impresion_persona'], 'id_cargo' => $_POST['id_cargo'], 'flag_empleado' => $_POST['flag_empleado'] ]);
            break;
            
        case 'find':
            $PersonaModel->$action($_POST['id_persona']);
            break;

        case 'actualizar':
            $PersonaModel->$action(['dni_persona' => $_POST['identificacion_persona'], 'nombre_persona' => $_POST['nombre_persona'], 'apellido_persona' => $_POST['apellido_persona'], 'impresion_persona' => $_POST['impresion_persona'], 'id_cargo' => $_POST['id_cargo'], 'flag_empleado' => $_POST['flag_empleado'] ], $_POST['id_persona']);
            break;

        case 'eliminar':
            $PersonaModel->$action($_POST['id_persona']);
            break;
    }
    
}