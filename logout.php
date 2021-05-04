<?php
/*
    A esta página se accede desde el index.php con un enlace cuando estás logueado y te desloguea
*/
    session_start(); // inicia sesión

    session_unset(); // libera todas las variables de sesión

    session_destroy(); // destruye toda la información registrada de la sesión

    header('Location: /stockmaker') // header con ruta /stockmaker
?>