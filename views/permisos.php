<?php
$active21 = "active";
$page = "Permisos";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_21 == 0) {
  echo '<script> location="dashboard"; </script>';
}
include '../models/TipoProcesoModel.php';
$rmodel = new TipoProcesoModel;
$resultados = $rmodel->searchTable('rol');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Permisos
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Seguridad</a></li>
      <li><a href="#">Permisos</a></li>
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
            <div class="col-xs-3">
            </div>
                <div class="col-xs-6">
                  <label>Rol: </label>
                  <select name="tipo_proceso" id="tipo_proceso" class="form-control" onchange="cargaPermiso(this.value)">
                  <option value="">Seleccione...</option>
                    <?php foreach ($resultados as $row): ?>
                        <option value="<?php echo $row->id_rol; ?>"><?php echo $row->descripcion_rol; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-xs-3">
            </div>
            </div>
            <div class="row">
            <div class="col-xs-12">
              <div class="records_permisos"></div>
              </div>
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
<script type="text/javascript" src="../dist/js/permiso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>