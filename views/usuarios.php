<?php
  $active19="active";
  $page = "Usuarios";
  include "static/head.php"; 
  include "static/header.php";
  include "static/aside.php";
  if ($permiso_19 == 0) {
    echo '<script> location="dashboard"; </script>';
  }
  include '../models/UsuarioModel.php';
  $rmodel = new UsuarioModel;
  $resultados = $rmodel->consulta();
  $comboPersona = $rmodel->searchTable('persona');
  $comboRol = $rmodel->searchTable('rol');
  $comboEquipo = $rmodel->searchTable('equipo_trabajo');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Seguridad</a></li>
      <li><a href="#">Usuarios</a></li>
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default-usuario"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar usuario
            </button><br><br>
            <table id="example1" class="display responsive nowrap table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Rol</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <?php foreach($resultados as $r): ?>
              <tr idcampo="<?php echo $r->id_usuario; ?>">
                  <td class="text-center"><?php echo $r->id_usuario; ?></td>
                  <td class="text-center"><?php echo $r->persona; ?></td>
                  <td class="text-center"><?php echo $r->descripcion_rol; ?></td>
                  <td class="text-center">
                    <a class="btn btn-primary" onclick="getData(<?php echo $r->id_usuario; ?>)"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" onclick="eliminar(<?php echo $r->id_usuario; ?>)"><i class="fas fa-trash-alt"></i></a>
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
  include 'components/modalUsuario.php';
?>
<script type="text/javascript" src="../dist/js/usuario.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>
<script>
  $(document).ready(function() {
      $('#example1').DataTable( {
        "order": [],
        "language": {
                    "url": "../spanish.json"
                }
      } );
  } );
  
</script>