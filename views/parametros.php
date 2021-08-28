<?php
$active22 = "active";
$page = "Parámetros";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/UsuarioModel.php';
include '../models/ParametroModel.php';
$rmodel = new UsuarioModel;
$pmodel = new ParametroModel;
$resultados = $rmodel->consulta();
$comboPersona = $rmodel->searchTable('persona');
$documentos = $pmodel->cargaParametros();
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Parámetros
    </h1>
    <ol class="breadcrumb">
      <li><a href="#">Parámetros</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <div id="tabs" name="tabs" class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" onClick=""><i class="fas fa-upload"></i> Documentos</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab2" data-toggle="tab" onClick=""><i class="fas fa-toggle-on"></i> Habilitar login</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1" name="tab1">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Misión y visión</h3>
                        </div>
                        <div class="box-body">
                          <?php if ($documentos[0]->ruta_vision_mision!='')
                          { ?>
                            <div class="row">
                            <embed src="../storage/mision_vision/<?php echo $documentos[0]->ruta_vision_mision; ?>" type="application/pdf" width="100%" height="300"></embed>
                          </div>
                         <?php } ?>
                          <br>
                          <form enctype="multipart/form-data" id="sube_mision_vision" method="post">
                            <input type="file" id="mision_vision" name="mision_vision" class="form-control" title="Misión y visión">
                          </form>
                          <br>
                          <a onclick="subirMisionVision()" class="btn btn-success"><i class="fa fa-upload"></i> Subir archivo</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Organigrama</h3>
                        </div>
                        <div class="box-body">
                        <?php if ($documentos[0]->ruta_organigrama!='')
                          { ?>
                            <div class="row">
                            <img src="../storage/organigrama/<?php echo $documentos[0]->ruta_organigrama; ?>" width="100%" height="300">
                          </div>
                         <?php } ?>
                          <br>
                          <form enctype="multipart/form-data" id="sube_organigrama" method="post">
                            <input type="file" id="organigrama" name="organigrama" class="form-control" title="Organigrama">
                          </form>
                          <br>
                          <a onclick="subirOrganigrama()" class="btn btn-success"><i class="fa fa-upload"></i> Subir archivo</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2" name="tab2">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Acceso</th>
                          </tr>
                        </thead>
                        <?php foreach ($resultados as $r) : ?>
                          <tr idcampo="<?php echo $r->id_usuario; ?>">
                            <td class="text-center"><?php echo $r->id_usuario; ?></td>
                            <td class="text-center"><?php echo $r->persona; ?></td>
                            <td class="text-center">
                              <label>
                                <?php
                                if ($r->acceso_usuario == 0) {
                                  $checked = '';
                                } else {
                                  $checked = 'checked';
                                }
                                ?>
                                <input <?php echo $checked; ?> type="checkbox" data-toggle="toggle" data-width="100" data-on="Activo" data-off="Inactivo" data-onstyle="success" data-offstyle="danger" id="activa_<?php echo $r->id_usuario; ?>" onchange="activaUsuario(<?php echo $r->id_usuario; ?>)">
                              </label>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </div>
                  </div>
                </div>
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
include 'components/modalCargando.php';
?>
<script type="text/javascript" src="../dist/js/parametro.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "order": []
    });
  });
</script>