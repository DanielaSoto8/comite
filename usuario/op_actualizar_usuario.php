<?php
require_once('../config/config.php');
session_start(); // Asegúrate de que la sesión esté iniciada

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $perfil = $_POST['perfil'];
    $estado = isset($_POST['estado']) ? 1 : 0; // Si el checkbox está marcado, estado es 1 (activo)

    // Validación de los datos (esto es opcional, puedes agregar más validaciones si lo deseas)
    if (empty($usuario) || empty($nombres) || empty($apellidos) || empty($perfil)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    try {
        // Preparar la consulta de actualización
        $consulta = $pdo->prepare("UPDATE usuario SET usuario = ?, nombres = ?, apellidos = ?, id_perfil = ?, estado = ? WHERE id = ?");
        
        // Ejecutar la consulta
        $consulta->execute([$usuario, $nombres, $apellidos, $perfil, $estado, $id]);

        // Establecer un mensaje en la sesión que indique que la actualización fue exitosa
        $_SESSION['mensaje'] = 'Usuario actualizado con éxito';

        // Redirigir al usuario a la página de inicio o cualquier página que desees
        header("Location: usuario.php"); // Cambia esta URL por la que desees
        exit;

    } catch (PDOException $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
}
?>
