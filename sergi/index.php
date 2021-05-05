<!--
    Página inicial.
    Desde aquí se puede ir al login (iniciar sesión) o al registro.
-->
<?php
    session_start();

    require 'database.php'; // carga la conexión con la base de datos

    if(isset($_SESSION['user_id'])) {
        $records = $conn->prepare(
            // select del usuario en dónde id igual a 'user_id' (':id')
            'SELECT id, username, nombre, apellidos, email, rol, password FROM usuarios WHERE id = :id'
        ); 
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0) { // Si el resultado no está vacío
            $user = $results;     // se asigna a user.
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>StockMaker</title>
        <link rel="preconnect" href="https://fonts.gstatic.com"> <!-- estilo de fuente -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css"> <!-- hoja de estilo general -->
    </head>
    <body>

        <?php require 'partials/header.php' ?> <!-- header embedido -->

        <?php if(!empty($user)): ?> <!-- si la variable user no está vacía ha logueado -->
            <!-- esta parte es lo que se muestra cuando estás logueado -->
            <br>Bienvenido, <?= $user['username'] ?>
            <br>Has iniciado sesión
            <a href="logout.php">Logout</a> <!-- este enlace conduce al logout.php que te desloguea
        <?php else: ?> <!-- si no está logueado se muestra la página inicial -->
            <!-- esta parte es lo que se muestra cuando NO estás logueado -->
            <h1>Porfavor inicia sesión o regístrate</h1>
            <a href="login.php">Iniciar de sesión</a> o <!-- Desde aquí puedes ir al login -->
            <a href="signup.php">Registrarse</a>        <!-- o al registro. -->
            <?php endif; ?>
    </body>
</html>