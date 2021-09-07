<?php
$active17 = "active";
$page = "Inasistencia";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_17 == 0) {
  echo '<script> location="dashboard"; </script>';
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Inasistencia
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Reportes</a></li>
      <li><a href="#">Inasistencia</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <div class="box-body">
            <div class="row">
              <form action="pdf_inasistencia" method="post" name="reporte" target="_blank">
                <div class="col-xs-5">
                  <label>Fecha desde: </label>
                  <input type="date" name="fecha_desde" id="fecha_desde" class="form-control">
                </div>
                <div class="col-xs-5">
                  <label>Fecha hasta: </label>
                  <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control">
                </div>
                <div class="col-xs-2">
                  <br>
                  <button class="btn btn-basic"><i class="far fa-file-pdf" style="color: red"></i> Generar reporte</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
include 'static/footer.php';
?>
<?php
include 'components/modalCargo.php';
?>
<script type="text/javascript" src="../dist/js/cargo.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>