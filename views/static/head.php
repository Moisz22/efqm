<?php
/*session_start(); 
  if(!isset($_SESSION["user_efqm"]) || $_SESSION["user_efqm"]==null){
    if (isset($active10)||isset($active12)||isset($active13)||isset($active14)||isset($active15)||isset($active16)||isset($active17)||isset($active18)) 
    {
          header("location: ../../login.php");
    }
    else
         header("location: login.php");
      }
  $foto = $_SESSION['ruta'];*/
  ?>
<!DOCTYPE html>
<html lang="es">
  <head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/ico" href="../dist/img/icono.ico" />
    <title>EFQM | <?php if(isset($page)){echo $page;}?></title>
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
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <!--ESTILO PARA MENSAJE DE NOTIFICACION-->
      <link rel="stylesheet" type="text/css" href="../dist/css/style.css">


    <style type="text/css">
      table.dataTable thead tr th {
      text-align: center;
      background-color: #004e91;
      color: white;
      }
    </style>

         <style type="text/css">
  img{border:0}
  
#container{
  padding:30px;
  } 
  
  #easy_zoom{
  width:800px;
  height:300px; 
  border:5px solid #eee;
  background:#fff;
  color:#333;
  position:absolute;
  top:500px;
  left:260px;
  overflow:hidden;
  -moz-box-shadow:0 0 10px #777;
  -webkit-box-shadow:0 0 10px #777;
  box-shadow:0 0 10px #777;
  /* vertical and horizontal alignment used for preloader text */
  line-height:400px;
  text-align:center;
  }
    </style>
    <!--SCRIPTS PARA ZOOM DE IMAGEN-->    
  </head>