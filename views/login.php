<?php
$page = "Login";
?>
<!--BOOTSTRAP -->
<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<!--PLANTILLA-->
<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
<!--ESTILO PARA MENSAJE DE NOTIFICACION-->
<link rel="stylesheet" type="text/css" href="../dist/css/style.css">

<body class="hold-transition login-page">
  <div class="login-box">

    <div class="login-logo">
      <a href="../index">
        <img src="../dist/img/logo_color.png" width="50%">
      </a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Iniciar Sesión</p>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="user" placeholder="Username" required title="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pwd" placeholder="Password" required title="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="login()" class="btn btn-primary" id="btnLogin" name="login" value="Ingresar">
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../dist/js/core.js"></script>
<script src="../dist/js/login.js"></script>
<script type="text/javascript" src="../dist/js/jquery.notification.js"></script>