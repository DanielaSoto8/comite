<?php
require_once(__DIR__ . '/config/config.php');

session_start();

if ($_SESSION['permisos'] === '3' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $id_perfil = 2;

    try {
        // Verificar si el usuario ya existe
        $consulta_usuario_existente = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE usuario = ?");
        $consulta_usuario_existente->execute([$usuario]);
        $existe_usuario = $consulta_usuario_existente->fetchColumn();

        if ($existe_usuario) {
            // Si el usuario existe, redirigir a registrar.php con un mensaje de error
            header("Location: registrar.php?error=El usuario ya existe");
            exit;
        } else {
            // Si el usuario no existe, proceder con la inserción en la base de datos
            $consulta_insertar_usuario = $pdo->prepare("INSERT INTO usuario (usuario, contrasenia, nombres, apellidos, id_perfil, estado) VALUES (?, ?, ?, ?, ?, 1)");
            $consulta_insertar_usuario->execute([$usuario, $contrasenia, $nombres, $apellidos, $id_perfil]);
            
            echo "Usuario creado exitosamente.";
        }
    } catch (PDOException $e) {
        echo "Error al crear usuario: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
