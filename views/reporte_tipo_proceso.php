<?php
$active16 = "active";
$page = "Reporte por tipo proceso";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/TipoProcesoModel.php';
$rmodel = new TipoProcesoModel;
$resultados = $rmodel->searchTable('tipo_proceso');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reporte por tipo proceso
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Reportes</a></li>
      <li><a href="#">Reporte por tipo proceso</a></li>
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
              <form action="pdf_reporte_tipo_proceso" method="post" name="reporte" target="_blank">
                <div class="col-xs-6">
                  <label>Tipo de proceso: </label>
                  <select name="tipo_proceso" id="tipo_proceso" class="form-control" required>
                  <option value="">Seleccione...</option>
                    <?php foreach ($resultados as $row): ?>
                        <option value="<?php echo $row->id_tipo_proceso; ?>"><?php echo $row->descripcion_tipo_proceso; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-xs-6">
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