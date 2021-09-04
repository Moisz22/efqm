<?php
$active1 = "active";
$page = "Filosofía";
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
      Filosofía
    </h1>
    <ol class="breadcrumb">
      <li class="active">Filosofía</li>
    </ol>
  </section>
  <section class="content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <embed src="../storage/mision_vision/<?php echo $documentos[0]->ruta_vision_mision.'#zoom=48'; ?>" type="application/pdf" width="100%" height="600"></embed>
      </div>
    </div>
  </section>
</div>
<?php include 'static/footer.php'; ?>
<script src="../dist/js/dashboard.js"></script>