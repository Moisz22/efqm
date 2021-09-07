<?php
$active18 = "active";
$page = "Indicadores";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_18 == 0) {
  echo '<script> location="dashboard"; </script>';
}
include "../models/IndicadorModel.php";
$imodel = new IndicadorModel();

$comboCategoria = $imodel->searchTable('categoria_indicador');
if (isset($_GET['id']))
{
  $id = base64_decode($_GET['id']);
  $indicadores = $imodel->searchTableWhere('indicador', 'id_categoria_indicador', $id);
}
else
  $indicadores = $imodel->consulta();
?>
<script src="../node_modules/jquery/dist/jquery.js"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Indicadores
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Reportes</a></li>
      <li><a href="#">Indicadores</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <label>Filtrar por categoría: </label>
                <select class="form-control" required id="categoria_indicador" name="categoria_indicador" onchange="filtraGrafico(this.value)">
                  <option value="">TODOS</option>
                  <?php foreach ($comboCategoria as $row) :
                    if ($id != '') {
                      $selected_categoria = ($id  == $row->id_categoria_indicador) ? 'selected' : '';
                    } else
                      $selected_categoria = '';
                  ?>
                    <option <?php echo $selected_categoria; ?> value="<?php echo $row->id_categoria_indicador; ?>"><?php echo $row->descripcion_categoria_indicador; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($indicadores as $row) : ?>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="chart_<?php echo $row->id_indicador; ?>" style="width:50%;" height="100"></canvas>
            </div>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            graficoReporte(<?php echo $row->id_indicador . "," . "'" . $row->descripcion_indicador . "'"; ?>);
          });
        </script>
      <?php endforeach; ?>
    </div>
  </section>
</div>
<?php
include 'static/footer.php';
?>
<?php
include 'components/modalCargo.php';
?>
<script type="text/javascript" src="../dist/js/indicador_detalle.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>