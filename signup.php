<!--
    Registro.
        TODO: implementar confirmación de contraseña
-->
<?php
    require 'database.php'; // carga la conexión con la base de datos

    $message = '';
    
    if(!empty($_POST['username'])
        && !empty($_POST['password'])
        && !empty($_POST['nombre'])    // Si las los campos formulario se han rellanado y enviado 
        && !empty($_POST['apellidos']) // se ejectua el script.
        && !empty($_POST['email'])
        && !empty($_POST['rol'])) {
            // guarda una sentencia SQL con un insert del usuario nuevo
        $sql = "INSERT INTO usuarios (username, nombre, apellidos, email, rol, password)
                VALUES (:username, :nombre, :apellidos, :email, :rol, :password)";
        $stmt = $conn->prepare($sql); // prepara la sentencia en el conector
        $stmt->bindParam(':username', $_POST['username']); 
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellidos', $_POST['apellidos']); // Asigna las variables de la sentencia
        $stmt->bindParam(':email', $_POST['email']);         // a los campos del formulario.
        $stmt->bindParam(':rol', $_POST['rol']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // encripta la contraseña
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = 'Successfully created new user'; // se guarda mensaje exitoso
        } else {
            $message = 'Sorry there must have been an issue creating your account'; // si falla
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com"> <!-- fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- hoja de estilo general -->
</head>
<body>
    <?php require 'partials/header.php' ?> <!-- header embedido -->

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p> <!-- cuando envía el formulario de registro muestra el mensaje -->
    <?php endif; ?>

    <h1>Registro</h1>
    <span>o <a href="login.php">Iniciar de sesión</a></span>
    <!-- formulario de registro -->
    <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="Introduce un usuario">
        <input type="password" name="password" placeholder="Introduce una contraseña">
            <!-- confirmación de contraseña no implementada -->
        <input type="password" name="confirm_password" placeholder="Confirma la contraseña">
        <input type="text" name="nombre" placeholder="Introduce tu nombre">
        <input type="text" name="apellidos" placeholder="Introduce tus apellidos">
        <input type="email" name="email" placeholder="Introduce tu email">
        <select name="rol">
            <option value="empleado" selected>Empleado</option>
            <option value="encargado">Encargado</option>
            <option value="admin">Admin</option>
            <option value="serviciotecnico">Servicio técnico</option>
        </select>
        <input type="submit" value="Send">
    </form>
</body>
</html>