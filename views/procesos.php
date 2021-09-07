<?php
$active13 = "active";
$page = "Procesos";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_13 == 0) {
  echo '<script> location="dashboard"; </script>';
}
include '../models/ProcesoModel.php';
include '../models/AprobacionModel.php';
include '../controllers/ProcesoController.php';
$rmodel = new ProcesoModel;
$aproModel = new AprobacionModel;
$resultados = $rmodel->consulta();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Procesos
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Operativo</a></li>
      <li><a href="#">Procesos</a></li>
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
            <a href="crea_proceso" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Proceso</a>
            <br><br>
            <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Proceso</th>
                  <th>Tipo de proceso</th>
                  <th>Propietario</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach ($resultados as $r) : ?>
                <tr idcampo="<?php echo $r->id_proceso; ?>">
                  <td class="text-center"><?php echo $r->descripcion_proceso; ?></td>
                  <td class="text-center"><?php echo $r->descripcion_tipo_proceso; ?></td>
                  <td class="text-center"><?php echo ($r->descripcion_cargo); ?></td>
                  <td class="text-center"><?php echo date('d/m/Y', strtotime($r->fecha_elaboracion_proceso)); ?></td>
                  <?php
                  $datoAprobacion = $aproModel->consultaAprobacion($r->id_proceso);
                  $estado_aprobacion = (!empty($datoAprobacion)) ? '<span class="label label-success">Aprobado</span>' : '<span class="label label-warning">Pendiente de aprobación</span>';
                  ?>
                  <td class="text-center"><?php echo $estado_aprobacion; ?></td>
                  <td class="text-center">
                    <?php
                    if (empty($datoAprobacion)) { ?>
                      <a class="btn btn-success" onclick="aprobar(<?php echo $r->id_proceso . ', ' . $_SESSION['id_usuario']; ?>)"><i class="fas fa-check"></i></a>
                    <?php  }
                    ?>
                    <a class="btn btn-warning" target="_blank" href="ficha_proceso?id=<?php echo base64_encode($r->id_proceso); ?>"><i class="far fa-file-pdf"></i></a>
                    <a class="btn btn-primary" href="crea_proceso?id=<?php echo base64_encode($r->id_proceso); ?>"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    if (empty($datoAprobacion)) { ?>
                      <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_proceso; ?>)"><i class="fas fa-trash-alt"></i></a>
                    <?php  }
                    ?>

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
<script src="../dist/js/proceso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>