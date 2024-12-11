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
    $correo_electronico = $_POST['correo_electronico'];
    $perfil = $_POST['id_perfil'];
    $estado = $_POST['estado'];
     

    // Validación de los datos (esto es opcional, puedes agregar más validaciones si lo deseas)
    if (empty($usuario) || empty($nombres) || empty($apellidos) ||empty($correo_electronico) || empty($perfil) || empty($estado)) {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
        header("Location: usuario.php");
        exit;
    }

    try {
        // Preparar la consulta de actualización
        $consulta = $pdo->prepare("UPDATE usuario SET usuario = ?, nombres = ?, apellidos = ?, correo_electronico = ?, id_perfil = ?, estado = ? WHERE usuario = ?");
        
        // Ejecutar la consulta
        $consulta->execute([$usuario, $nombres, $apellidos,$correo_electronico, $perfil, $estado, $usuario]);

        // Establecer un mensaje en la sesión que indique que la actualización fue exitosa
        $_SESSION['mensaje'] = 'Usuario actualizado con éxito';

        // Redirigir al usuario a la página de inicio o cualquier página que desees
        header("Location: usuario.php"); // Cambia esta URL por la que desees
        exit;

    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al actualizar el usuario: ";
        header("Location: usuario.php");
    }
}
?>
