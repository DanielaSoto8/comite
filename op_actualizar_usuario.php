<?php
require_once('config.php');

session_start();

if ($_SESSION['perfil'] === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $id_perfil = $_POST['perfil'];
    $estado = isset($_POST['estado']) ? 1 : 0;

    try {
        $consulta = $pdo->prepare("UPDATE usuario SET usuario=?, nombres=?, apellidos=?, id_perfil=?, estado=? WHERE id=?");
        $consulta->execute([$usuario, $nombres, $apellidos, $id_perfil, $estado, $id]);
        
        echo "Usuario actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
