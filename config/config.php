

<?php

$environment = 'production'; 

if ($environment == 'development') {
    $host = 'localhost';
    $nombre_db = 'comite';
    $usuario_db = 'root';
    $contrasenia_db = '';
} else {
    $host = 'localhost';
    $nombre_db = 'comite';
    $usuario_db = 'mysql';
    $contrasenia_db = '';
}


$conn = new mysqli($host, $usuario_db, $contrasenia_db, $nombre_db);


if ($conn->connect_error) {
    die("Error al conectar a la base de datos con mysqli: " . $conn->connect_error);
}


try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_db;charset=utf8", $usuario_db, $contrasenia_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error al conectar a la base de datos con PDO: ' . $e->getMessage());
}
?>