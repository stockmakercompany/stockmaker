<?php
    // variables para conexión con base de datos
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'stockmaker';

    try {   // conexión con base de datos
        $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
    } catch(PDOException $e) {
        die('Connnected failed: '.$e->getMessage()); // si falla
    }
?>