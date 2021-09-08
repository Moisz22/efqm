<?php
$active1 = "active";
$page = "Dashboard";
include "static/head.php";
include "static/header.php";
include "static/aside.php";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content container-fluid">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="filosofia" style="color: black;">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fas fa-hands-helping"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">
                <h4><b>Filosofía</b></h4>
              </span>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="organigrama.php" style="color: black;">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-sitemap"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">
                <h4><b>Organigrama</b></h4>
              </span>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="grafico_indicador" style="color: black;">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fas fa-thumbtack"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">
                <h4><b>Indicadores</b></h4>
              </span>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Procesos por tipo</h3>
          </div>
          <div class="box-body" id="renderizarCanvas">
          </div>
        </div>
      </div>
    <h4>
    </h4>
    <br>
  </section>
</div>
<?php include 'static/footer.php'; ?>
<script src="../dist/js/dashboard.js"></script>