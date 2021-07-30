<?php
$active14 = "active";
$page = "Indicadores";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/ProcesoModel.php';
include '../controllers/ActividadController.php';
include '../controllers/ProcesoController.php';
$rmodel = new ProcesoModel;
$resultados = $rmodel->consulta();
$comboCriterioEfqm = $rmodel->searchTable('criterio_efqm');
$comboFrecuencia = $rmodel->searchTable('frecuencia');
$comboCategoria = $rmodel->searchTable('categoria_indicador');

if (isset($_GET['id'])) {
  $id = base64_decode($_GET['id']);
  $display = 'block';
  $datoIndicador = $rmodel->searchTableWhere('indicador', 'id_indicador', $id);
  $boton = 'Actualizar';
  $funcion = 'actualizar';
} else {
  $id = '';
  $display = 'none';
  $datoIndicador = '';
  $boton = 'Guardar';
  $funcion = 'agregar';
}
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
            <h3 class="box-title">
              <button id="btn_regresar" name="btn_regresar" class='btn btn-danger' type="button" onclick="window.history.back();"><span class='fa fa-chevron-left'></span> Volver</button>
              <a id="btn_guardar" onclick="<?php echo $funcion; ?>()" class="btn  btn-success"><?php echo $boton; ?></a>
            </h3>
          </div>
          <div class="box-body">
            <div id="tabs" name="tabs" class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" onClick=""><span class="fa fa-clipboard"></span> Datos Generales</a></li>
                <li class="mostrarOpcion" style="display: <?php echo $display; ?>;"><a href="#tab2" data-toggle="tab" onClick=""><span class="fas fa-tasks"></span> Datos</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1" name="tab1">
                  <div class="row">
                    <input type="hidden" id="id_indicador" value="<?php echo $id; ?>">
                    <div class="form-group col-md-6">
                      <label>Descripción del indicador: </label>
                      <input type="text" value="<?php echo ($id != '') ? $datoIndicador[0]->descripcion_indicador : ''; ?>" id="descripcion_indicador" style="width: 100%;" class="form-control" required title="Descripción del indicador">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Fórmula del indicador: </label>
                      <input type="text" value="<?php echo ($id != '') ? $datoIndicador[0]->formula_indicador : ''; ?>" id="formula_indicador" style="width: 100%;" class="form-control" required title="Fórmula del indicador">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Criterio EFQM: </label>
                      <select class="form-control" id="criterio_efqm" title="Criterio EFQM">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboCriterioEfqm as $row) :
                          if ($id != '') {
                            $selected_criterio_efqm = ($datoIndicador[0]->id_criterio_efqm == $row->id_criterio_efqm) ? 'selected' : '';
                          } else
                            $selected_criterio_efqm = '';
                        ?>
                          <option <?php echo $selected_criterio_efqm; ?> value="<?php echo $row->id_criterio_efqm; ?>"><?php echo $row->descripcion_criterio_efqm; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Meta: </label>
                      <input type="number" value="<?php echo ($id != '') ? $datoIndicador[0]->meta_indicador : ''; ?>" id="meta_indicador" style="width: 100%;" class="form-control" required title="Meta">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Frecuencia de medición:</label>
                      <select class="form-control" required id="frecuencia_indicador" name="frecuencia_indicador" title="Frecuencia de medición">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboFrecuencia as $row) :
                          if ($id != '') {
                            $selected_propietario = ($datoIndicador[0]->id_frecuencia_indicador == $row->id_frecuencia) ? 'selected' : '';
                          } else
                            $selected_propietario = '';
                        ?>
                          <option <?php echo $selected_propietario; ?> value="<?php echo $row->id_frecuencia; ?>"><?php echo $row->descripcion_frecuencia; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Categoría: </label>
                      <select class="form-control" required id="categoria_indicador" name="categoria_indicador" title="Versión">
                        <option value="">Seleccione...</option>
                        <?php foreach ($comboCategoria as $row) :
                          if ($id != '') {
                            $selected_version = ($datoIndicador[0]->id_categoria_indicador  == $row->id_categoria_indicador) ? 'selected' : '';
                          } else
                            $selected_version = '';
                        ?>
                          <option <?php echo $selected_version; ?> value="<?php echo $row->id_categoria_indicador; ?>"><?php echo $row->descripcion_categoria_indicador; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2" name="tab2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Valores</h3>
                          </div>
                          <div class="box-body">
                            <a data-toggle="modal" class="btn btn-success" href="#modal-default-indicador-detalle"><i class="fa fa-plus"></i></a><br><br>
                            <div class="records_indicador_detalles"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <canvas id="chart1" style="width:50%;" height="100"></canvas>
                      </div>
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
include 'components/modalIndicadorDetalle.php';
?>
<script type="text/javascript" src="../dist/js/indicador.js"></script>
<script type="text/javascript" src="../dist/js/indicador_detalle.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>