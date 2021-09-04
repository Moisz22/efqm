<?php
session_start();
if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_usuario"] == null) {
  header("location: login");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/ico" href="../dist/img/icono.ico" />
  <title>EFQM | <?php if (isset($page)) {
                  echo $page;
                } ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--BOOTSTRAP -->
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!--FONT-AWESOME-->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <!--SELECT2-->
  <link rel="stylesheet" href="../plugins/select2/dist/css/select2.min.css">
  <!--PLANTILLA-->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!--DATATABLES-->
  <link rel="stylesheet" type="text/css" href="../node_modules/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="../node_modules/datatables.net-responsive-dt/css/responsive.dataTables.min.css">
  <!--GRAPH-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!--ESTILO Y TAMAÑO DE FUENTE-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!--ESTILO PARA MENSAJE DE NOTIFICACION-->
  <link rel="stylesheet" type="text/css" href="../dist/css/style.css">
  <!--BOOTSTRAP TOGGLE-->
  <link rel="stylesheet" type="text/css" href="../node_modules/bootstrap-toggle/css/bootstrap-toggle.min.css">
  <!--ZOOM IMAGE-->
  <link rel="stylesheet" href="../plugins/easyZoom/css/easyzoom.css">
  <style type="text/css">
    table.dataTable thead tr th {
      text-align: center;
      background-color: #004e91;
      color: white;
    }
  </style>
</head>