<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="dashboard" class="logo">
        <span class="logo-mini">
          <div id='div_nav_logo_small' name='div_nav_logo_small'><img src="../dist/img/small.png"></div>
        </span>
        <span class="logo-lg">
          <div style="margin-left:-10px" id='div_nav_logo' name='div_nav_logo'><img src="../dist/img/logo.png"></div>
        </span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <p>
                    <?php echo $_SESSION['nombre']; ?>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="profile" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="logout" class="btn btn-default btn-flat">Cerrar sesión</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>