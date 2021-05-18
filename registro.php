<!--
    Registro.
-->
<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
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
<?php
    require './includes/database_2.php'; // carga la conexión con la base de datos

    $message = '';
    
    if(!empty($_POST['name'])
        && !empty($_POST['username'])       // Si las los campos formulario se han rellanado y 
        && !empty($_POST['password'])       // enviado se ejectua el script.
        && !empty($_POST['user_level'])) {       
            // guarda una sentencia SQL con un insert del usuario nuevo
        $sql = "INSERT INTO users (name, username, password ,user_level, image, status, last_login)
                VALUES (:name, :username, :password, :user_level, :image, '1', '')";
        $stmt = $conn->prepare($sql); // prepara la sentencia en el conector
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':username', $_POST['username']); 
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña.
        $stmt->bindParam(':password', $password);               // Asigna los campos del formulario a 
        $stmt->bindParam(':user_level', $_POST['user_level']);  // las variables y Asigna las    
        $stmt->bindParam(':image', $_POST['image']);            // variables a los campos de la
                                                                // sentencia.
        if ($stmt->execute()) {
            $message = 'Successfully created new user'; // se guarda mensaje exitoso
        } else {
            $message = 'Sorry there must have been an issue creating your account'; // si falla
        }

    }
?>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body id="body">
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p> <!-- cuando envía el formulario de registro muestra el mensaje -->
    <?php endif; ?>
    <div class="login-page">
    <h1>Registro</h1><br><br>
    <!-- formulario de registro -->
    <form action="registro.php" method="post" class="clearfix">
    <div class="form-group">
    <label for="username" class="control-label">Nombre:</label>
    <input class="reg-input" type="text" name="name" placeholder="Nombre"><br><br>
    </div>
    <div class="form-group">
    <label for="username" class="control-label">Usuario:</label>
    <input class="reg-input" type="text" name="username" placeholder="Nombre de usuario"><br><br>
    </div>   
    <div class="form-group">
    <label for="username" class="control-label">Contraseña:</label>
    <input class="reg-input" type="password" name="password" placeholder="Contraseña"><br><br>
    </div>       
    <div class="form-group">
    <label for="username" class="control-label">Roles:</label>
    <select class="reg-input" type="number" name="user_level" placeholder="Nivel del usuario"><br><br>
            <option value="1" selected>Administrado</option>
            <option value="2">Encargado</option>
            <option value="3">Empleado</option>
        </select><br>
    </div>  
    <div class="form-group">
    <input class="reg-input" type="file" name="image"><br><br><br>
        <input type="submit" value="Registrar" class="btn btn-primary">
        <a href="index.php" class="btn btn-primary" style="float:rigth">Login</a>
        </div>

    </form>
    </div>
</body>
<?php include_once('layouts/footer.php'); ?>