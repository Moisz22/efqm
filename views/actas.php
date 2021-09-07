<?php
$active15 = "active";
$page = "Actas de equipos";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_15 == 0) {
  echo '<script> location="dashboard"; </script>';
}
include '../models/ActaModel.php';
include '../controllers/ActaController.php';
$rmodel = new ActaModel;
$resultados = $rmodel->consulta();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Actas de equipos
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Operativo</a></li>
      <li><a href="#">Actas de equipos</a></li>
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
          <a href="crea_acta" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar acta</a>
            <br><br>
            <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Secuencial</th>
                  <th>Equipo</th>
                  <th>Orden del día</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach ($resultados as $r) : ?>
                <tr idcampo="<?php echo $r->id_acta; ?>">
                <td class="text-center"><?php echo $r->id_acta; ?></td>  
                <td class="text-center"><?php echo $r->secuencial_acta; ?></td>  
                <td class="text-center"><?php echo $r->descripcion_equipo_trabajo; ?></td>
                  <td class="text-center"><?php echo $r->orden_acta; ?></td>
                  <td class="text-center"><?php echo date('d/m/Y', strtotime($r->fecha_acta)); ?></td>
                  <td class="text-center"><?php echo ($r->hora_inicio_acta); ?></td>
                  <td class="text-center">
                    <a class="btn btn-warning" target="_blank" href="pdf_acta?id=<?php echo base64_encode($r->id_acta); ?>"><i class="far fa-file-pdf"></i></a>
                    <a class="btn btn-primary" href="crea_acta?id=<?php echo base64_encode($r->id_acta); ?>"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_acta; ?>)"><i class="fas fa-trash-alt"></i></a>
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
<script src="../dist/js/acta.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>