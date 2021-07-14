<?php
  $active5="active";
  $page = "Tipos de proceso";
  include "static/head.php"; 
  include "static/header.php";
  include "static/aside.php";
  include '../models/TipoProcesoModel.php';
  $rmodel = new TipoProcesoModel;
  $resultados = $rmodel->all();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tipos de proceso
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tipos de proceso</a></li>
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Tipo Proceso
            </button><br><br>
            <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripción</th>
                  <th>Abreviatura</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach($resultados as $r): ?>
              <tr idcampo="<?php echo $r->id_tipo_proceso; ?>">
                  <td class="text-center"><?php echo $r->id_tipo_proceso; ?></td>
                  <td class="text-center"><?php echo $r->descripcion_tipo_proceso; ?></td>
                  <td class="text-center"><?php echo $r->abreviatura_tipo_proceso; ?></td>
                  <td class="text-center">
                    <a class="btn btn-primary" onclick="getData(<?php echo $r->id_tipo_proceso; ?>)"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_tipo_proceso; ?>)"><i class="fas fa-trash-alt"></i></a>
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
  include 'components/modalTipoProceso.php';
  ?>
<script type="text/javascript" src="../dist/js/tipo_proceso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
      $('#example1').DataTable( {
        "order": []
      } );
  } );
  
</script>