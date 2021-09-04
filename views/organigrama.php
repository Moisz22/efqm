<?php
$active1 = "active";
$page = "Organigrama";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
include '../models/ParametroModel.php';
$pmodel = new ParametroModel;
$documentos = $pmodel->cargaParametros();
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Organigrama
    </h1>
    <ol class="breadcrumb">
      <li class="active">Organigrama</li>
    </ol>
  </section>
  <section class="content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="easyzoom easyzoom--overlay">
          <a href="../storage/organigrama/<?php echo $documentos[0]->ruta_organigrama; ?>">
            <img src="../storage/organigrama/<?php echo $documentos[0]->ruta_organigrama; ?>" alt="" width="100%">
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'static/footer.php'; ?>
<script src="../dist/js/dashboard.js"></script>
<script>
  // Instantiate EasyZoom instances
  let $easyzoom = $('.easyzoom').easyZoom();
</script>