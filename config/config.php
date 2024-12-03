<?php
// Datos de conexión a la base de datos
// config.php
$host = 'localhost';       // El servidor de base de datos (usualmente 'localhost')
$nombre_db = 'comite';     // El nombre de tu base de datos
$usuario_db = 'root';      // Tu nombre de usuario de MySQL
$contrasenia_db = '';      // Tu contraseña de MySQL (vacío si no tienes contraseña para 'root')

// Crear la conexión
$conn = new mysqli($host, $usuario_db, $contrasenia_db, $nombre_db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

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
