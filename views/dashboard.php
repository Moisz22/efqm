<?php
  $active1="active";
  $page="Inicio";
  include "static/head.php"; 
  include "static/header.php";
  /*include 'consultas.php';*/
  include "static/aside.php";
  /*include "/pages/config/conexion.php";*/
    ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimientos</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content container-fluid">
    <div class="row">
    </div>
    <h4>
    </h4>
    <br>
  </section>
</div>
<?php include 'static/footer.php'; ?>
<script>
  $(document).ready(function() {
      $('#example1').DataTable( {
          "order": [[0, "asc" ]]
      } );
  } );
  
</script>