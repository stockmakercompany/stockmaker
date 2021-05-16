<!--
    Registro.
        TODO: implementar confirmación de contraseña
-->
<?php
    require './includes/database_2.php'; // carga la conexión con la base de datos

    $message = '';
    
    if(!empty($_POST['name'])
        && !empty($_POST['username'])
        && !empty($_POST['password'])       // Si las los campos formulario se han rellanado y 
        && !empty($_POST['user_level'])     // enviado se ejectua el script.
        && !empty($_POST['image'])) {       
            // guarda una sentencia SQL con un insert del usuario nuevo
        $sql = "INSERT INTO usuarios (name, username, password ,user_level, image, status, last_login)
                VALUES (:username, :name, :password, :user_level, :image, '1', NOW())";
        $stmt = $conn->prepare($sql); // prepara la sentencia en el conector
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':username', $_POST['username']); 
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña.
        $stmt->bindParam(':password', $password);               // Asigna los campos del formulario a 
        $stmt->bindParam(':user_level', $_POST['user_level']);  // las variables y Asigna las 
        $stmt->bindParam(':apellidos', $_POST['apellidos']);    // variables a los campos de la
        $stmt->bindParam(':image', $_POST['image']);            // sentencia.

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
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body">
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p> <!-- cuando envía el formulario de registro muestra el mensaje -->
    <?php endif; ?>

    <h1>Registro</h1>
    <!-- formulario de registro -->
    <form action="signup.php" method="post">
        <input class="reg-input" type="text" name="name" placeholder="Nombre">
        <input class="reg-input" type="text" name="username" placeholder="Nombre de usuario">
        <input class="reg-input" type="password" name="password" placeholder="Contraseña">
        <select class="reg-input" type="number" name="user_level" placeholder="Nivel del usuario">
            <option value=1 selected>Admin User</option>
            <option value=2>Special User</option>
            <option value=3>Default User</option>
        </select>
        <input class="reg-input" type="file" name="image">
        <input class="reg-submit" type="submit" value="Send">
    </form>
</body>
</html>