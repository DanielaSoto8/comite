<?php
require_once('config.php');

session_start();

if ($_SESSION['permisos'] === '3' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $id_perfil = $_POST['perfil'];

    try {
        $consulta = $pdo->prepare("INSERT INTO usuario (usuario, contrasenia, nombres, apellidos, id_perfil, estado) VALUES (?, ?, ?, ?, ?, 1)");
        $consulta->execute([$usuario, $contrasenia, $nombres, $apellidos, $id_perfil]);
        
        echo "Usuario creado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al crear usuario: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
