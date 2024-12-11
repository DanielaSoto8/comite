<?php
require_once('../config/config.php');

session_start();

if ($_SESSION['id_perfil'] == 1 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];

    try {
        // Realizar la eliminación
        $consulta = $pdo->prepare("DELETE FROM usuario WHERE usuario=?");
        $consulta->execute([$usuario]);

        // Establecer mensaje de éxito en la sesión
        $_SESSION['mensaje'] = "Usuario eliminado correctamente.";
        header("Location: usuario.php"); // Redirigir después de la eliminación
        exit();
    } catch (PDOException $e) {
        // En caso de error
        $_SESSION['mensaje'] = "Error al eliminar el usuario: " . $e->getMessage();
        header("Location: usuario.php");
        exit();
    }
} else {
    $_SESSION['mensaje'] = "Error al eliminar el usuario: No tiene permisos para esta acción";
    header("Location: usuario.php");
    exit;
}
?>
