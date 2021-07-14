  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="<?php if(isset($active1)){echo $active1;}?>"><a href="dahboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>        
        <li><a href="pages/indicadores/index.php"><i class="fas fa-thumbtack"></i> <span>Indicadores</span></a></li>
        <li><a href="pages/actas_reunion/index.php"><i class="fas fa-file-signature"></i> <span>Actas de equipo</span></a></li>
        <li class="<?php if(isset($active21)){echo $active21;}?>"><a href="manual.php"><i class="fas fa-file-pdf-o"></i><span> Manual de usuario</span></a></li>
        <li class="<?php if(isset($active23)){echo $active23;}?>"><a href="http://apps.colegioamericano.edu.ec/evaluaciones" target="_blank"><i class="fas fa-list-ol"></i><span> Evaluaciones</span></a></li>
        <li class="<?php if(isset($active7)){echo $active7;}?>"><a href="https://es.surveymonkey.com/home/?ut_source=header" target="_blank"><i class="fas fa-tasks"></i><span> Encuestas</span></a></li>
        <li><a href="pages/actualizacion_datos/procesos.php"><i class="fas fa-clipboard-list"></i> <span>Procesos</span></a></li> -->
        <li class="treeview <?php if(isset($active2)||isset($active3)||isset($active4)||isset($active5)||isset($active6)||isset($active7)||isset($active8)||isset($active9)){echo 'active';}?>">
          <a href="#">
          <i class="fas fa-wrench"></i> <span>Mantenimientos</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($active2)){echo $active2;}?>"><a href="recursos"><i class="fas fa-toolbox"></i> <span>Recursos</span></a></li>
            <li class="<?php if(isset($active3)){echo $active3;}?>"><a href="version"><i class="fas fa-code-branch"></i> <span>Versión</span></a></li>
            <li class="<?php if(isset($active4)){echo $active4;}?>"><a href="cargos"><i class="fas fa-briefcase"></i> <span>Cargos</span></a></li>
            <li class="<?php if(isset($active5)){echo $active5;}?>"><a href="tipo_proceso"><i class="fas fa-clipboard-list"></i> <span>Tipos de proceso</span></a></li>
            <li class="<?php if(isset($active6)){echo $active6;}?>"><a href="frecuencia"><i class="fas fa-ruler"></i> <span>Frecuencia</span></a></li>
            <li class="<?php if(isset($active7)){echo $active7;}?>"><a href="criterio_efqm"><i class="fas fa-object-group"></i> <span>Criterio EFQM</span></a></li>
            <li class="<?php if(isset($active8)){echo $active8;}?>"><a href="categoria_indicador"><i class="fab fa-elementor"></i> <span>Categoria indicador</span></a></li>
            <li class="<?php if(isset($active9)){echo $active9;}?>"><a href="tipo_documento"><i class="far fa-copy"></i> <span>Tipo de documento</span></a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>