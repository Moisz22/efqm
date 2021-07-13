<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
     <?php if (isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)||isset($active13)||isset($active14)||isset($active15)||isset($active16)||isset($active17)) { echo '<a href="../../index.php" class="logo">';} else {echo '<a href="index.php" class="logo">';}?>
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
             <!--<?php if (isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)||isset($active13)||isset($active14)||isset($active15)||isset($active16)||isset($active17)||isset($active18)) { echo '<img src="../../fotos/'.$foto.'"  class="user-image" alt="User Image">';} else {echo '<img src="fotos/'.$foto.'"  class="user-image" alt="User Image">';}?>-->

              <span class="hidden-xs"><?php echo $_SESSION['user_efqm']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
               <!--<?php if (isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)||isset($active13)||isset($active14)||isset($active15)||isset($active16)||isset($active17)||isset($active18)) { echo '<img src="../../fotos/'.$foto.'"   class="img-circle" alt="User Image">';} else {echo '<img src="fotos/'.$foto.'"  class="img-circle" alt="User Image">';}?>-->
                <p>
                  <?php echo $_SESSION['user_efqm']; ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                      <?php if (isset($active8)||isset($active9)||isset($active10)||isset($active11)||isset($active12)||isset($active13)||isset($active14)||isset($active15)||isset($active16)||isset($active17)||isset($active18)) { echo '<a href="../../logout.php" class="btn btn-default btn-flat">Sign out</a>';} else {echo '<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>';}?>

                    </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>