<?php
require_once('../config/config.php');

session_start();

if ($_SESSION['id_perfil'] === 3 && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    try {
        // Realizar la eliminación
        $consulta = $pdo->prepare("DELETE FROM usuario WHERE id=?");
        $consulta->execute([$id]);

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
    header("Location: ../index.php");
    exit;
}
?>
