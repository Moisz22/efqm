<?php
$active1 = "active";
$page = "Perfil";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/PersonaModel.php';
include '../controllers/PersonaController.php';
$rmodel = new PersonaModel;
$datoPersona = $rmodel->consultaPorId($_SESSION['id_persona']);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Perfil
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <h3 class="profile-username text-center"><?php echo $_SESSION['nombre']; ?></h3>
            <div class="box-body">
              <hr>
              <strong><i class="fa fa-university margin-r-5"></i>Cargo:</strong>
              <p class="text-muted"><?php echo $datoPersona[0]->descripcion_cargo; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Cambiar contraseña</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="settings">
              <div class="form-horizontal">
                <div class="form-group">
                  <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                  <label for="inputEmail" class="col-sm-2 control-label">Contraseña:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="actual_clave" id="contrasena_actual" title="Contraseña actual">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Nueva contraseña:</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="usuario_clave" id="nueva_contrasena" title="Nueva contraseña">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Repetir contraseña nueva:</label>
                  <div class="col-sm-10">
                    <input type="password" name="usuario_clave_conf" class="form-control" id="confirmacion_nueva_contrasena" title="Confirmación de contraseña">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-success" name="enviar" onclick="cambiaPassword()" value="Actualizar"><i class="fa fa-save"></i>&nbsp;Cambiar</button>
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

<?php include 'static/footer.php'; ?>
<script src="../dist/js/profile.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
