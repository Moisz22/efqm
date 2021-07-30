<?php
$active13 = "active";
$page = "Procesos";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/ProcesoModel.php';
include '../controllers/ActividadController.php';
include '../controllers/ProcesoController.php';
$rmodel = new ProcesoModel;
$resultados = $rmodel->consulta();
$comboTipoProceso = $rmodel->searchTable('tipo_proceso');
$comboPropietario = $rmodel->searchTableWhere('cargo', 'jefe_cargo', 1);
$comboVersion = $rmodel->searchTable('version');
$comboIndicador = $rmodel->searchTable('indicador');
$comboProceso = $rmodel->searchTable('proceso');
$comboResponsable = $rmodel->searchTableWhere('cargo', 'jefe_cargo', 0);
$comboTipoDocumento = $rmodel->searchTable('tipo_documento');
$comboRecurso = $rmodel->searchTable('recurso');
$comboResponsableSubactividad = $rmodel->searchTable('cargo');
if (isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);
  $display = 'block';
  $datoProceso = $rmodel->searchTableWhere('proceso', 'id_proceso', $id);
  $selectedIndicadores = $rmodel->selected('proceso_indicador', 'id_proceso', $id);
  $array_indicador = array();
  if ($selectedIndicadores !== false) {
    foreach ($selectedIndicadores as $is) {
      array_push($array_indicador, $is['id_indicador']);
    }
  }

  $selectedResponsables = $rmodel->selected('responsable_proceso', 'id_proceso', $id);
  $array_responsable = array();
  if ($selectedResponsables !== false) {
    foreach ($selectedResponsables as $ir) {
      array_push($array_responsable, $ir['id_cargo']);
    }
  }

  $selectedRelacionados = $rmodel->selected('proceso_relacionado', 'id_proceso', $id);
  $array_relacionados = array();
  if ($selectedRelacionados !== false) {
    foreach ($selectedRelacionados as $ipr) {
      array_push($array_relacionados, $ipr['id_proceso_relacionado']);
    }
  }

  $boton = 'Actualizar';
  $funcion = 'actualizar';

} else {
  $id = '';
  $display = 'none';
  $datoProceso = '';
  $boton = 'Guardar';
  $funcion = 'agregar';
}
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
            <h3 class="box-title">
              <button id="btn_regresar" name="btn_regresar" class='btn btn-danger' type="button" onclick="window.history.back();"><span class='fa fa-chevron-left'></span> Volver</button>
              <a id="btn_guardar" onclick="<?php echo $funcion; ?>()" class="btn  btn-success"><?php echo $boton; ?></a>
            </h3>
          </div>
          <div class="box-body">
            <div id="tabs" name="tabs" class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" onClick=""><span class="fa fa-clipboard"></span> Datos Generales</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab2" data-toggle="tab" onClick=""><span class="fa fa-users"></span> Actividades</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab3" data-toggle="tab" onClick=""><i class="fas fa-tasks"></i> Sub actividades:</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab4" data-toggle="tab" onClick=""><span class="fas fa-arrow-up"></span> Entradas:</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab5" data-toggle="tab" onClick=""><span class="fas fa-arrow-down"></span> Salidas:</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab6" data-toggle="tab" onClick=""><span class="fa fa-lightbulb-o"></span> Políticas</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab7" data-toggle="tab" onClick=""><span class="far fa-folder-open"></span> Anexos</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab8" data-toggle="tab" onClick=""><i class="fas fa-exchange-alt"></i></span> Control de cambios</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab9" data-toggle="tab" onClick=""><i class="fas fa-archive"></i></span> Recursos</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1" name="tab1">
                  <div class="row">
                    <input type="hidden" id="id_proceso" value="<?php echo $id; ?>">
                    <div class="form-group col-md-6">
                      <label>Nombre del Proceso: </label>
                      <input type="text" value="<?php echo ($id != '') ? $datoProceso[0]->descripcion_proceso : ''; ?>" id="nombre_proceso" style="width: 100%;" class="form-control" required title="Nombre del Proceso">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Abreviatura del Proceso: </label>
                      <input type="text" value="<?php echo ($id != '') ? $datoProceso[0]->abreviatura_proceso : ''; ?>" id="abreviatura_proceso" style="width: 100%;" class="form-control" required title="Abreviatura del Proceso">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tipo de Proceso: </label>
                      <select class="form-control" id="tipo_proceso" title="Tipo de Proceso">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboTipoProceso as $row) :
                          if ($id != '') {
                            $selected_tipo_proceso = ($datoProceso[0]->id_tipo_proceso == $row->id_tipo_proceso) ? 'selected' : '';
                          } else
                            $selected_tipo_proceso = '';
                        ?>
                          <option <?php echo $selected_tipo_proceso; ?> value="<?php echo $row->id_tipo_proceso; ?>"><?php echo $row->descripcion_tipo_proceso; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Propietario: </label>
                      <select class="form-control" required id="propietario" name="propietario" title="Propietario">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboPropietario as $row) :
                          if ($id != '') {
                            $selected_propietario = ($datoProceso[0]->id_propietario_proceso == $row->id_cargo) ? 'selected' : '';
                          } else
                            $selected_propietario = '';
                        ?>
                          <option <?php echo $selected_propietario; ?> value="<?php echo $row->id_cargo; ?>"><?php echo $row->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Versión: </label>
                      <select class="form-control" required id="version" name="version" title="Versión">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboVersion as $row) :
                          if ($id != '') {
                            $selected_version = ($datoProceso[0]->id_version_proceso == $row->id_version) ? 'selected' : '';
                          } else
                            $selected_version = '';
                        ?>
                          <option <?php echo $selected_version; ?> value="<?php echo $row->id_version; ?>"><?php echo $row->descripcion_version; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Fecha de elaboración: </label>
                      <input type="date" id="fecha_elaboracion" value="<?php echo ($id != '') ? $datoProceso[0]->fecha_elaboracion_proceso : ''; ?>" style="width: 100%;" required class="form-control" title="Fecha de elaboración">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Objetivo: </label>
                      <textarea id="objetivo" name="objetivo" class="form-control" title="Objetivo"><?php echo ($id != '') ? $datoProceso[0]->objetivo_proceso : ''; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Alcance:</label>
                      <textarea id="alcance" name="alcance" class="form-control" title="Alcance"><?php echo ($id != '') ? $datoProceso[0]->alcance_proceso : ''; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Responsables: </label>
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="responsables" name="responsables[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboResponsable as $row) : 
                        if ($id!='')
                        {
                          $selected_responsable = (in_array($row->id_cargo, $array_responsable)) ? 'selected' : '';
                        }
                        else
                          $selected_responsable ='';
                      ?>
                      <option <?php echo $selected_responsable; ?> value="<?php echo $row->id_cargo; ?>"><?php echo $row->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Indicadores: </label>
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="indicador" name="indicador[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboIndicador as $row) : 
                          if ($id!='')
                            {
                              $selected_indicador = (in_array($row->id_indicador, $array_indicador)) ? 'selected' : '';
                            }
                            else
                              $selected_indicador ='';
                          ?>
                          <option <?php echo $selected_indicador; ?> value="<?php echo $row->id_indicador; ?>"><?php echo $row->descripcion_indicador; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Procesos relacionados: </label>
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="procesos_relacionados" name="procesos_relacionados[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboProceso as $row) : 
                        if ($id!='')
                        {
                          $selected_relacionado = (in_array($row->id_proceso, $array_relacionados)) ? 'selected' : '';
                        }
                        else
                          $selected_relacionado ='';
                      ?>
                      <option <?php echo $selected_relacionado; ?> value="<?php echo $row->id_proceso; ?>"><?php echo $row->descripcion_proceso; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>



                </div>
                <div class="tab-pane" id="tab2" name="tab2">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#modal-default-actividad"><i class="fa fa-plus"></i></a><br><br>
                      <div class="records_actividades"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab3" name="tab3">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#modal-default-subactividad"><i class="fa fa-plus"></i></a><br><br>
                      <div class="records_subactividades"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab4" name="tab4">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#modal-default-entrada"><i class="fa fa-plus"></i></a><br><br>
                      <div class="records_entradas"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab5" name="tab5">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#modal-default-salida"><i class="fa fa-plus"></i></a><br><br>
                      <div class="records_salidas"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab6" name="tab6">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#modal-default-politica"><i class="fa fa-plus"></i></a><br><br>
                      <div class="records_politicas"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab7" name="tab7">
                  <div class="row">
                    <div class="col-md-12">
                      <form enctype="multipart/form-data" id="sube_anexo" method="post">
                        <div class="form-group col-md-6">
                          <label for="empleados">Tipo Documento: </label>
                          <select class="form-control" id="tipo_documento_anexo" name="tipo_documento_anexo" required title="Tipo de documento">
                            <option value="">Seleccione...</option>
                            <?php foreach ($comboTipoDocumento as $rowd) : ?>
                              <option value="<?php echo $rowd->id_tipo_documento; ?>"><?php echo $rowd->descripcion_tipo_documento; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="empleados">Descripción de documento: </label>
                          <input type="text" name="descripcion_anexo_proceso" id="descripcion_anexo_proceso" style="width: 100%;" class="form-control" required title="Descripción de documento">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="first_name">Actividad asociada: </label>
                          <select class="form-control cbx_actividad" name="id_actividad_anexo_proceso" id="id_actividad_anexo_proceso" title="Actividad asociada"></select>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Seleccione archivo:</label>
                          <input type="file" id="anexo" name="anexo" class="form-control" title="Anexo">
                      </form>
                    </div>
                    <div class="form-group col-md-6">
                      <br>
                      <a onclick="agregarAnexoProceso()" class="btn btn-success"><i class="fa fa-upload"></i> Subir anexo</a>
                    </div>
                    <div class="form-group col-md-12">
                      <br><br>
                      <div class="records_anexo_proceso"></div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="tab-pane" id="tab8" name="tab8">
                <div class="row">
                  <div class="col-md-12">
                    <a data-toggle="modal" class="btn btn-success" href="#modal-default-control-cambio"><i class="fa fa-plus"></i></a><br><br>
                    <div class="records_control_cambio"></div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab9" name="tab9">
                <div class="row">
                  <div class="col-md-12">
                    <a data-toggle="modal" class="btn btn-success" href="#modal-default-recurso-proceso"><i class="fa fa-plus"></i></a><br><br>
                    <div class="records_recursos"></div>
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
include 'components/modalActividad.php';
include 'components/modalSubactividad.php';
include 'components/modalEntrada.php';
include 'components/modalSalida.php';
include 'components/modalPolitica.php';
include 'components/modalControlCambio.php';
include 'components/modalAnexoProceso.php';
include 'components/modalRecursoProceso.php';
?>
<script type="text/javascript" src="../dist/js/proceso.js"></script>
<script type="text/javascript" src="../dist/js/control_cambio.js"></script>
<script type="text/javascript" src="../dist/js/actividad.js"></script>
<script type="text/javascript" src="../dist/js/subactividad.js"></script>
<script type="text/javascript" src="../dist/js/entrada.js"></script>
<script type="text/javascript" src="../dist/js/salida.js"></script>
<script type="text/javascript" src="../dist/js/politica.js"></script>
<script type="text/javascript" src="../dist/js/anexo_proceso.js"></script>
<script type="text/javascript" src="../dist/js/recurso_proceso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $('.select2').select2()
</script>