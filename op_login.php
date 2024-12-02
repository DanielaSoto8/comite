<?php
require_once(__DIR__ . '/config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    try {
        // Preparar la consulta SQL para verificar las credenciales del usuario
        $consulta = $pdo->prepare("Select usuario.id, usuario.usuario, usuario.contrasenia, usuario.nombres, usuario.apellidos, usuario.id_perfil, usuario.estado, perfil.permisos From perfil Inner Join usuario On usuario.id_perfil = perfil.id Where usuario.usuario = ? And usuario.contrasenia = ? And usuario.estado = 1");
        // Ejecutar la consulta
        $consulta->execute([$usuario, $contrasenia]);

        // Verificar si se encontraron resultados
        if ($consulta->rowCount() == 1) {
            // Obtener los datos del usuario
            $row = $consulta->fetch(PDO::FETCH_ASSOC);

            // Iniciar la sesión y almacenar los datos del usuario en variables de sesión
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['nombres'] = $row['nombres'];
            $_SESSION['apellidos'] = $row['apellidos'];
            $_SESSION['id_perfil'] = $row['id_perfil'];
            $_SESSION['estado'] = $row['estado'];

            // Redireccionar al usuario a la página de inicio
            header('Location: index.php');
            exit();
        } else {
            // Si no se encuentra ningún usuario válido, mostrar un mensaje de error
            echo "No se encontró ningún usuario válido.<br>";
        }
    } catch (PDOException $e) {
        // Si ocurre un error en la consulta, mostrar el mensaje de error
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    // Si se intenta acceder a este script sin una solicitud POST, redirigir a otra página (opcional)
    header("Location: login.php");
    exit;
}
?>