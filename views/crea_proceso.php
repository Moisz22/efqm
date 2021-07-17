<?php
  $active13="active";
  $page = "Procesos";
  include "static/head.php"; 
  include "static/header.php";
  include "static/aside.php";
  include '../models/ProcesoModel.php';
  $rmodel = new ProcesoModel;
  $resultados = $rmodel->consulta();
  $comboTipoProceso = $rmodel->searchTable('tipo_proceso');
  $comboPropietario = $rmodel->searchTableWhere('cargo', 1);
  $comboVersion = $rmodel->searchTable('version');
  $comboIndicador = $rmodel->searchTable('indicador');
  $comboProceso = $rmodel->searchTable('proceso');
  $comboResponsable = $rmodel->searchTableWhere('cargo', 0);
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
              <a onclick="agregar()" class="btn  btn-success">Guardar</a>
            </h3>
          </div>
          <div class="box-body">
            <div id="tabs" name="tabs" class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" onClick=""><span class="fa fa-clipboard"></span> Datos Generales</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab2" data-toggle="tab" onClick=""><span class="fa fa-users"></span> Actividades</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab3" data-toggle="tab" onClick=""><span class="fas fa-arrow-up"></span> Entradas:</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab4" data-toggle="tab" onClick=""><span class="fas fa-arrow-down"></span> Salidas:</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab5" data-toggle="tab" onClick=""><span class="fa fa-lightbulb-o"></span> Políticas</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab6" data-toggle="tab" onClick=""><span class="far fa-folder-open"></span> Anexos</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab7" data-toggle="tab" onClick=""><i class="fas fa-exchange-alt"></i></span> Control de cambios</a></li>
                <li class="mostrarOpcion" style="display: none;"><a href="#tab8" data-toggle="tab" onClick=""><i class="fas fa-archive"></i></span> Recursos</a></li>                
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1" name="tab1">
                  <div class="row">
                    <input type="hidden" id="id_proceso">
                    <div class="form-group col-md-6">
                      <label>Nombre del Proceso: </label>      
                      <input type="text" id="nombre_proceso"  style="width: 100%;" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Abreviatura del Proceso: </label>      
                      <input type="text" id="abreviatura_proceso"  style="width: 100%;" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tipo de Proceso: </label>      
                      <select class="form-control" id="tipo_proceso">
                        <option value="">Seleccione...</option>
                        <?php foreach($comboTipoProceso as $row): ?>
                        <option value="<?php echo $row->id_tipo_proceso; ?>"><?php echo $row->descripcion_tipo_proceso; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Propietario</label>
                      <select class="form-control" required id="propietario" name="propietario">
                        <option value="">Seleccione...</option>
                        <?php foreach($comboPropietario as $row): ?>
                        <option value="<?php echo $row->id_cargo; ?>"><?php echo $row->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Version</label>
                      <select class="form-control" required id="version" name="version">
                        <option value="">Seleccione...</option>
                        <?php foreach($comboVersion as $row): ?>
                        <option value="<?php echo $row->id_version; ?>"><?php echo $row->descripcion_version; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Fecha de elaboración: </label>      
                      <input type="date" id="fecha_elaboracion" style="width: 100%;" required class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Objetivo: </label>      
                      <textarea id="objetivo" name="objetivo" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Responsables: </label>      
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="responsables" name="responsables[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach($comboResponsable as $row): ?>
                        <option value="<?php echo $row->id_cargo; ?>"><?php echo $row->descripcion_cargo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Indicadores: </label>      
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="indicador" name="indicador[]" data-placeholder="Seleccione..." >
                        <option value="">Seleccione...</option>
                        <?php foreach($comboIndicador as $row): ?>
                        <option value="<?php echo $row->id_indicador; ?>"><?php echo $row->descripcion_indicador; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Procesos relacionados: </label>      
                      <select class="form-control select2 invi_int" style="width: 100%;" multiple="multiple" id="procesos_relacionados" name="procesos_relacionados[]" data-placeholder="Seleccione...">
                        <option value="">Seleccione...</option>
                        <?php foreach($comboProceso as $row): ?>
                        <option value="<?php echo $row->id_proceso; ?>"><?php echo $row->descripcion_proceso; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <label>Alcance:</label>
                  <textarea id="alcance" name="alcance" class="form-control"></textarea>
                </div>
                <div class="tab-pane" id="tab2" name="tab2">
                  <div class="row">
                    <div class="col-md-12">
                      <a data-toggle="modal" class="btn btn-success" href="#add_new_record_modal"><i class="fa fa-plus"></i></a>
                      <div class="records_actividades"></div>
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
  ?>
<script type="text/javascript" src="../dist/js/proceso.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
      $('#example1').DataTable( {
        "order": []
      } );
  } );
  
</script>
<script>
  $('.select2').select2()
</script>