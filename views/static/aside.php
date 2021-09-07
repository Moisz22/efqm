<?php
  include '../models/PermisoModel.php';
  $perModel = new PermisoModel;
  $datosPermiso = $perModel->consulta($_SESSION['rol']);
  foreach ($datosPermiso as $rowper)
  {
    ${"permiso_".$rowper->opcion_permiso} = $rowper->flag_permiso;
  }
?>  
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if(isset($active1)){echo $active1;}?>"><a href="dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
        <li class="treeview <?php if(isset($active2)||isset($active3)||isset($active4)||isset($active5)||isset($active6)||isset($active7)||isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)){echo 'active';}?>">
          <a href="#">
          <i class="fas fa-wrench"></i> <span>Mantenimientos</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($permiso_2==1): ?>
             <li class="<?php if(isset($active2)){echo $active2;}?>"><a href="recursos"><i class="fas fa-toolbox"></i> <span>Recursos</span></a></li>
            <?php endif; ?>
            <?php if ($permiso_3==1): ?>
             <li class="<?php if(isset($active3)){echo $active3;}?>"><a href="version"><i class="fas fa-code-branch"></i> <span>Versión</span></a></li>
            <?php endif; ?>
            <?php if ($permiso_4==1): ?>
              <li class="<?php if(isset($active4)){echo $active4;}?>"><a href="cargos"><i class="fas fa-briefcase"></i> <span>Cargos</span></a></li>
            <?php endif; ?>
            <?php if ($permiso_5==1): ?>
            <li class="<?php if(isset($active5)){echo $active5;}?>"><a href="tipo_proceso"><i class="fas fa-clipboard-list"></i> <span>Tipos de proceso</span></a></li>
            <?php endif; ?>
            <?php if ($permiso_6==1): ?>
              <li class="<?php if(isset($active6)){echo $active6;}?>"><a href="frecuencia"><i class="fas fa-ruler"></i> <span>Frecuencia</span></a></li>
            <?php endif;?>
            <?php if ($permiso_7==1): ?>
            <li class="<?php if(isset($active7)){echo $active7;}?>"><a href="criterio_efqm"><i class="fas fa-object-group"></i> <span>Criterio EFQM</span></a></li>
            <?php endif;?>
            <?php if ($permiso_8==1): ?>
            <li class="<?php if(isset($active8)){echo $active8;}?>"><a href="categoria_indicador"><i class="fab fa-elementor"></i> <span>Categoria indicador</span></a></li>
            <?php endif;?>            
            <?php if ($permiso_9==1): ?>
              <li class="<?php if(isset($active9)){echo $active9;}?>"><a href="tipo_documento"><i class="far fa-copy"></i> <span>Tipo de documento</span></a></li>
            <?php endif;?>
            <?php if ($permiso_10==1): ?>
              <li class="<?php if(isset($active10)){echo $active10;}?>"><a href="lugares"><i class="fas fa-map"></i> <span>Lugares</span></a></li>
            <?php endif;?>
            <?php if ($permiso_11==1): ?>
              <li class="<?php if(isset($active11)){echo $active11;}?>"><a href="persona"><i class="fas fa-users"></i> <span>Personas</span></a></li>
            <?php endif;?>
            <?php if ($permiso_12==1): ?>
              <li class="<?php if(isset($active12)){echo $active12;}?>"><a href="equipo_trabajo"><i class="far fa-handshake"></i> <span>Equipos de trabajo</span></a></li>
            <?php endif;?>
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
          <?php if ($permiso_13==1): ?>
            <li class="<?php if(isset($active13)){echo $active13;}?>"><a href="procesos"><i class="fas fa-clipboard-list"></i> <span>Procesos</span></a></li>
            <?php endif;?>
            <?php if ($permiso_14==1): ?>
              <li class="<?php if(isset($active14)){echo $active14;}?>"><a href="indicadores"><i class="fas fa-thumbtack"></i> <span>Indicadores</span></a></li>
            <?php endif;?>
            <?php if ($permiso_15==1): ?>
              <li class="<?php if(isset($active15)){echo $active15;}?>"><a href="actas"><i class="fas fa-file-signature"></i> <span>Actas de equipo</span></a></li>
            <?php endif;?>
          </ul>
        </li>
        <li class="treeview <?php if(isset($active16)||isset($active17)||isset($active18)){echo 'active';}?>">
          <a href="#">
          <i class="fas fa-folder-open"></i> <span>Reportes</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
          <?php if ($permiso_16==1): ?>
            <li class="<?php if(isset($active16)){echo $active16;}?>"><a href="reporte_tipo_proceso"><i class="fas fa-file-pdf"></i> <span>Reporte por tipo de proceso</span></a></li>
            <?php endif;?>
            <?php if ($permiso_17==1): ?>
              <li class="<?php if(isset($active17)){echo $active17;}?>"><a href="inasistencia"><i class="fas fa-file-pdf"></i> <span>Inasistencia</span></a></li>
            <?php endif;?>
            <?php if ($permiso_18==1): ?>
              <li class="<?php if(isset($active18)){echo $active18;}?>"><a href="grafico_indicador"><i class="fas fa-chart-line"></i> <span>Gráficos de indicadores</span></a></li>
            <?php endif;?>
          </ul>
        </li>
          <li class="treeview <?php if(isset($active19)||isset($active20)||isset($active21)){echo 'active';}?>">
          <a href="#">
          <i class="fas fa-shield-alt"></i> <span>Seguridad</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
          <?php if ($permiso_19==1): ?>
            <li class="<?php if(isset($active19)){echo $active19;}?>"><a href="usuarios"><i class="fas fa-users"></i> <span>Usuarios</span></a></li>
          <?php endif;?>
          <?php if ($permiso_20==1): ?>
            <li class="<?php if(isset($active20)){echo $active20;}?>"><a href="roles"><i class="fas fa-briefcase"></i> <span>Roles</span></a></li>
          <?php endif;?>
          <?php if ($permiso_21==1): ?>
            <li class="<?php if(isset($active21)){echo $active21;}?>"><a href="permisos"><i class="fas fa-user-lock"></i> <span>Permisos</span></a></li>
          <?php endif;?>
          </ul>
        </li>
        <?php if ($permiso_22==1): ?>
          <li class="<?php if(isset($active22)){echo $active22;}?>"><a href="parametros"><i class="fas fa-sliders-h"></i> <span>Parámetros</span></a></li>
        <?php endif;?>
      </ul>
    </section>
  </aside>