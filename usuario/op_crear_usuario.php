<?php
// Incluir la configuración de la base de datos
require_once('../config/config.php');
session_start();
// Verificar si los datos del formulario fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo_electronico = $_POST['correo_electronico'];
    $id_perfil = $_POST['id_perfil'];
    $estado = $_POST['estado'];

    // Validaciones si es necesario (por ejemplo, para asegurarte que no estén vacíos)
    if (empty($usuario) || empty($contrasenia) || empty($nombres) || empty($apellidos) || empty($correo_electronico) || empty($id_perfil) || empty($estado)) {
        echo "Todos los campos son requeridos.";
        exit;
    }
    
    $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);

    // Aquí realizarías el SQL para insertar los datos
    $sql = "INSERT INTO usuario (usuario, contrasenia, nombres, apellidos, correo_electronico, id_perfil, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    if ($stmt->execute([$usuario, $contrasenia, $nombres, $apellidos, $correo_electronico, $id_perfil, $estado])) {
        $_SESSION['mensaje'] = "Usuario creado correctamente.";
    
    } else {
        $_SESSION['mensaje'] = "Error al crear el usuario.";
        
    }
    header("location: usuario.php");
    exit;
}
