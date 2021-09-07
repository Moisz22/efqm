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
$comboLugar = $rmodel->searchTable('lugar');
$comboInvitados = $rmodel->searchTable('persona');
$comboEquipo = $rmodel->searchTable('equipo_trabajo');
if (isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);
  $display = 'block';
  $datoActa = $rmodel->searchTableWhere('acta', 'id_acta', $id);
  $selectedInvitados = $rmodel->selectedPersona($id, 0);
  $array_invitados = array();
  if ($selectedInvitados !== false) {
    foreach ($selectedInvitados as $inv) {
      array_push($array_invitados, $inv['id_persona']);
    }
  }
  $bloqueaEquipo = 'disabled';
  $boton = 'Actualizar';
  $funcion = 'actualizar';
} else {
  $id = '';
  $bloqueaEquipo = '';
  $display = 'none';
  $datoActa = '';
  $boton = 'Guardar';
  $funcion = 'agregar';
}
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
            <h3 class="box-title">
              <button id="btn_regresar" name="btn_regresar" class='btn btn-danger' type="button" onclick="window.history.back();"><span class='fa fa-chevron-left'></span> Volver</button>
              <a id="btn_guardar" onclick="<?php echo $funcion; ?>()" class="btn  btn-success"><?php echo $boton; ?></a>
            </h3>
          </div>
          <div class="box-body">
            <div id="tabs" name="tabs" class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" onClick=""><span class="fa fa-clipboard"></span> Datos Generales</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab2" data-toggle="tab" onClick=""><span class="far fa-folder-open"></span> Anexos</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1" name="tab1">
                  <div class="row">
                    <input type="hidden" id="id_acta" value="<?php echo $id; ?>">
                    <div class="form-group col-md-6" style="display: <?php echo $display; ?>;">
                      <label>Secuencial: </label>
                      <input type="text" value="<?php echo ($id != '') ? $datoActa[0]->secuencial_acta : ''; ?>" id="secuencial_acta" style="width: 100%;" class="form-control" required title="Secuencial">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Fecha de reunión: </label>
                      <input type="date" value="<?php echo ($id != '') ? $datoActa[0]->fecha_acta : ''; ?>" id="fecha_acta" style="width: 100%;" class="form-control" required title="Fecha de reunión">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Hora inicio de reunión: </label>
                      <input type="time" value="<?php echo ($id != '') ? $datoActa[0]->hora_inicio_acta : ''; ?>" id="hora_inicio_acta" style="width: 100%;" class="form-control" required title="Hora inicio de reunión">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Lugar de reunión: </label>
                      <select class="form-control" id="lugar" title="Lugar de reunión">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboLugar as $row) :
                          if ($id != '') {
                            $selected_lugar = ($datoActa[0]->id_lugar == $row->id_lugar) ? 'selected' : '';
                          } else
                            $selected_lugar = '';
                        ?>
                          <option <?php echo $selected_lugar; ?> value="<?php echo $row->id_lugar; ?>"><?php echo $row->descripcion_lugar; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Hora finalización de reunión: </label>
                      <input type="time" value="<?php echo ($id != '') ? $datoActa[0]->hora_finalizacion_acta : ''; ?>" id="hora_finalizacion_acta" style="width: 100%;" class="form-control" required title="Hora finalización de reunión">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Orden del día: </label>
                      <textarea id="orden_acta" name="orden_acta" class="form-control" title="Orden del día"><?php echo ($id != '') ? $datoActa[0]->orden_acta : ''; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Invitados: </label>
                      <select class="form-control select2 invitados" style="width: 100%;" multiple="multiple" id="invitados" name="invitados[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboInvitados as $row) :
                          if ($id != '') {
                            $selected_persona = (in_array($row->id_persona, $array_invitados)) ? 'selected' : '';
                          } else
                            $selected_persona = '';
                        ?>
                          <option <?php echo $selected_persona; ?> value="<?php echo $row->id_persona; ?>"><?php echo ($row->nombre_persona . ' ' . $row->apellido_persona); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label>Equipo de trabajo: </label>
                      <select <?php echo $bloqueaEquipo; ?> class="form-control" style="width: 100%;" id="equipo_trabajo" title="Equipo de trabajo" onchange="obtenerTablaEquipo(0)">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboEquipo as $row) :
                          if ($id != '') {
                            $selected_equipo_trabajo = ($datoActa[0]->id_equipo_trabajo == $row->id_equipo_trabajo) ? 'selected' : '';
                          } else
                            $selected_equipo_trabajo = '';
                        ?>
                          <option <?php echo $selected_equipo_trabajo; ?> value="<?php echo $row->id_equipo_trabajo; ?>"><?php echo $row->descripcion_equipo_trabajo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title"></h3>
                          <input type="hidden" name="id_miembro" id="id_miembro">
                        </div>
                        <div class="panel-body">
                          <div class="records_equipo"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label>Bitácora de aprendizaje: </label>
                      <textarea id="bitacora_aprendizaje_acta" name="bitacora_aprendizaje_acta" class="form-control" title="Bitácora de aprendizaje"><?php echo ($id != '') ? $datoActa[0]->bitacora_aprendizaje_acta : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label>Desarrollo de la reunión y Resoluciones: </label>
                      <textarea rows="15" id="desarrollo_acta" name="desarrollo_acta" class="form-control" title="Desarrollo de la reunión y Resoluciones"><?php echo ($id != '') ? $datoActa[0]->desarrollo_acta : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2" name="tab2">
                <div class="row">
                    <div class="col-md-12">
                      <form enctype="multipart/form-data" id="sube_anexo" method="post">
                        <div class="form-group col-md-6">
                          <label for="empleados">Descripción de documento: </label>
                          <input type="text" name="descripcion_anexo_acta" id="descripcion_anexo_acta" style="width: 100%;" class="form-control" required title="Descripción de documento">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Seleccione archivo:</label>
                          <input type="file" id="anexo" name="anexo" class="form-control" title="Anexo">
                      </form>
                    </div>
                    <div class="form-group col-md-6">
                      <br>
                      <a onclick="agregarAnexoActa()" class="btn btn-success"><i class="fa fa-upload"></i> Subir anexo</a>
                    </div>
                    <div class="form-group col-md-12">
                      <br><br>
                      <div class="records_anexo_acta"></div>
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
include 'components/modalAnexoActa.php';
?>
<script type="text/javascript" src="../dist/js/acta.js"></script>
<script type="text/javascript" src="../dist/js/anexo_acta.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $('.select2').select2()
</script>
<?php
if ($id != '') {
  echo '<script>
          $(document).ready(function () {
            obtenerTablaEquipo(' . $id . ')
          });
        </script>';
}
?>