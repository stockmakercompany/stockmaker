<?php

    session_start(); // inicia una sessión

    if(isset($_SESSION['user_id'])) {    // Si el id del usuario de la sesión está definido y no es null
        header('Location: /stockmaker'); // llama el header con la ruta /stockmaker.
    }

    require 'database.php'; // carga la base de datos

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        // ejecuta una sentencia SQL que devuelve el id, el usuario y la contraseña del usuario logueado
        $records = $conn->prepare('SELECT id, username, password FROM usuarios WHERE username=:username');
        $records->bindParam(':username', $_POST['username']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';
        // si el usuario existe, verifica la contraseña introducida en el login con la de la respuesta
        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /stockmaker'); // header con la ruta /stockmaker
        } else {
            $message = 'Sorry, those credentials do not match'; // si falla
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inico sesión</title>
    <link rel="preconnect" href="https://fonts.gstatic.com"> <!-- fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- hoja de estilo general -->
</head>
<body>

    <?php require 'partials/header.php' ?>

    <h1>Inico de sesión</h1>
    <span>o <a href="signup.php">Registrarse</a></span> <!-- link al registro -->

    <?php if(!empty($message)) : ?> <!-- si el mensaje no está vacío -->
        <p><?= $message ?></p> <!-- imprime el mensaje -->
    <?php endif;?>
    <!-- formulario del login -->
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Introduce tu usuario">
        <input type="password" name="password" placeholder="Introduce tu contraseña">
        <input type="submit" value="Send">
    </form>
</body>
</html>