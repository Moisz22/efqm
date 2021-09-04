<?php

require_once '../models/DashboardModel.php';

class DashboardController{

    private $dashboardModel;

    public function __construct () {
        $this->dashboardModel = new DashboardModel;
    }

    public function graficoProceso()
    {
        $this->dashboardModel->graficoProceso();
    }

}


$dashboardController = new DashboardController;


if(isset($_POST['action']) && !empty($_POST['action']))
{
    $accion = $_POST['action'];
    $dashboardController->$accion();
}

