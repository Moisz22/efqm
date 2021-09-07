<?php
$active2 = "active";
$page = "Recursos";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
if ($permiso_2 == 0) {
  echo '<script> location="dashboard"; </script>';
}
include '../models/RecursoModel.php';
$rmodel = new RecursoModel;
$resultados = $rmodel->all();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Recursos
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimientos</a></li>
      <li><a href="#">Recursos</a></li>
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Recurso
            </button><br><br>
            <table class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripción</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach ($resultados as $r) : ?>
                <tr idcampo="<?php echo $r->id_recurso; ?>">
                  <td class="text-center"><?php echo $r->id_recurso; ?></td>
                  <td class="text-center"><?php echo $r->descripcion_recurso; ?></td>
                  <td class="text-center">
                    <a class="btn btn-primary" onclick="getData(<?php echo $r->id_recurso; ?>)"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_recurso; ?>)"><i class="fas fa-trash-alt"></i></a>
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
<?php
include 'components/modalRecurso.php';
?>
<script type="text/javascript" src="../dist/js/recurso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('table.display').DataTable();
  });
</script>