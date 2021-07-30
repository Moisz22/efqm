<?php
$active14 = "active";
$page = "Indicadores";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/IndicadorModel.php';
include '../controllers/IndicadorController.php';
$rmodel = new IndicadorModel;
$resultados = $rmodel->consulta();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Indicadores
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Operativo</a></li>
      <li><a href="#">Indicadores</a></li>
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
          <a href="crea_indicador" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Indicador</a>
            <br><br>
            <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>EFQM</th>
                  <th>Descripción</th>
                  <th>Fórmula</th>
                  <th>Meta</th>
                  <th>Frecuencia</th>
                  <th>Categoria</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach ($resultados as $r) : ?>
                <tr idcampo="<?php echo $r->id_indicador; ?>">
                <td class="text-center"><?php echo $r->abreviatura_criterio_efqm; ?></td>  
                <td class="text-center"><?php echo $r->descripcion_indicador; ?></td>
                  <td class="text-center"><?php echo $r->formula_indicador; ?></td>
                  <td class="text-center"><?php echo ($r->meta_indicador); ?></td>
                  <td class="text-center"><?php echo ($r->descripcion_frecuencia); ?></td>
                  <td class="text-center"><?php echo ($r->descripcion_categoria_indicador); ?></td>
                  <td class="text-center">
                    <a class="btn btn-primary" href="crea_indicador?id=<?php echo base64_encode($r->id_indicador); ?>"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_indicador; ?>)"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
include 'static/footer.php';
?>
<script src="../dist/js/indicador.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>