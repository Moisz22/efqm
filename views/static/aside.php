  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php if(isset($active2)||isset($active3)||isset($active4)||isset($active5)||isset($active6)||isset($active7)||isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)){echo 'active';}?>">
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
            <li class="<?php if(isset($active10)){echo $active10;}?>"><a href="lugares"><i class="fas fa-map"></i> <span>Lugares</span></a></li>
            <li class="<?php if(isset($active11)){echo $active11;}?>"><a href="persona"><i class="fas fa-users"></i> <span>Personas</span></a></li>
            <li class="<?php if(isset($active12)){echo $active12;}?>"><a href="equipo_trabajo"><i class="far fa-handshake"></i> <span>Equipos de trabajo</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php if(isset($active13)||isset($active14)||isset($active15)){echo 'active';}?>">
          <a href="#">
          <i class="fas fa-cogs"></i> <span>Operativo</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($active13)){echo $active13;}?>"><a href="procesos"><i class="fas fa-clipboard-list"></i> <span>Procesos</span></a></li>
            <li class="<?php if(isset($active14)){echo $active14;}?>"><a href="indicadores"><i class="fas fa-thumbtack"></i> <span>Indicadores</span></a></li>
            <!--<li class="<?php if(isset($active15)){echo $active15;}?>"><a href="cargos"><i class="fas fa-briefcase"></i> <span>Cargos</span></a></li>-->
          </ul>
        </li>
      </ul>
    </section>
  </aside>