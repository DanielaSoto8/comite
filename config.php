<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // El servidor de la base de datos
$usuario_db = 'root'; // Tu nombre de usuario de MySQL
$contrasenia_db = ''; // Tu contraseña de MySQL
$nombre_db = 'comite'; // El nombre de tu base de datos

try {
    // Intenta establecer la conexión a la base de datos utilizando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_db;charset=utf8", $usuario_db, $contrasenia_db);
    // Habilita el manejo de excepciones en PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error en la conexión, muestra un mensaje de error
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}
?>
