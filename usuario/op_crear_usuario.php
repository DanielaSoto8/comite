<?php
// Incluir la configuración de la base de datos
require_once('../config/config.php');

// Verificar si los datos del formulario fueron enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $id_perfil = $_POST['perfil'];
    $estado = $_POST['estado']; // Si el estado es un campo textual, puede ser 'activo' o 'inactivo'

    // Encriptar la contraseña para mayor seguridad
    $contrasenia_encriptada = password_hash($contrasenia, PASSWORD_DEFAULT);

    try {
        // Preparar la consulta SQL para insertar los datos en la base de datos
        $consulta = $pdo->prepare("INSERT INTO usuario (usuario, contrasenia, nombres, apellidos, id_perfil, estado) VALUES (?, ?, ?, ?, ?, ?)");
        // Ejecutar la consulta
        $consulta->execute([$usuario, $contrasenia_encriptada, $nombres, $apellidos, $id_perfil, $estado]);

        // Redirigir a otra página o mostrar mensaje de éxito
        echo "Usuario creado exitosamente.";
        // O redirigir a una página
        // header('Location: index.php');
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error al crear el usuario: " . $e->getMessage();
    }
} else {
    // Si no es una solicitud POST, redirigir o mostrar un mensaje
    echo "Solicitud no válida.";
}
?>
