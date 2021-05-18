<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-image: url(./pictures/bg-login.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
    }
    .page {
      display: inline;
    }
    .login-page{
      padding: 20px;
      background-color: rgb(136 135 135 / 55%)
    }
    @media screen and (max-width: 460px) {
      .page{
        display: inline;
      }
      .login-page{
        padding-bottom: 20px;
        background-color: rgb(249 249 249 / 0%);
        width: 90%;
        border: none;
      }
    }
  </style>
</head>
<div class="login-page">
    <div class="text-center">
       <h1>Bienvenido</h1>
       <p>Iniciar sesión </p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Usario</label>
              <input type="name" class="form-control" name="username" placeholder="Usario">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Contraseña</label>
            <input type="password" name= "password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Entrar</button>
                <a href="registro.php" class="btn btn-primary" style="float:left">Registrarte</a>
                <br>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
