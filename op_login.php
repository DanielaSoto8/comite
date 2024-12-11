<?php
require_once(__DIR__ . '/config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $secret_key = '6Le9RZgqAAAAALAiX042-EAHs2a-qoy-aWkVg2PT'; // Reemplaza con tu clave secreta de reCAPTCHA
    $response = $_POST['g-recaptcha-response'];
    
    // Verificar que la respuesta de reCAPTCHA no esté vacía
    if (empty($response)) {
        header('Location: login.php?error=3'); // Redirigir si no se completó el reCAPTCHA
        exit;
    }

    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $verify_response = file_get_contents($verify_url . "?secret=" . $secret_key . "&response=" . $response);
    $verify_response = json_decode($verify_response);

    //print_r($verify_response);
    
    if ($verify_response->success) {
        try {
            // Preparar la consulta SQL para verificar las credenciales del usuario
            $consulta = $pdo->prepare("Select usuario.id, usuario.usuario, usuario.contrasenia, usuario.nombres, usuario.apellidos, usuario.id_perfil, usuario.estado, perfil.permisos From perfil Inner Join usuario On usuario.id_perfil = perfil.id Where usuario.usuario = ? And usuario.estado = 'activo'");
            // Ejecutar la consulta
            $consulta->execute([$usuario]);
    
            // Verificar si se encontraron resultados
            if ($consulta->rowCount() == 1) {
                // Obtener los datos del usuario
                $row = $consulta->fetch(PDO::FETCH_ASSOC);
                $contraseniaEncriptada = $row['contrasenia'];
    
                // Verificar la contraseña ingresada con la encriptada
                if (password_verify($contrasenia, $contraseniaEncriptada)) {
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
                }else {
                    // Si no se encuentra ningún usuario válido, mostrar un mensaje de error
                    header("Location: login.php?error=1");
                    exit;
                }
               
            } else {
                // Si no se encuentra ningún usuario válido, mostrar un mensaje de error
                header("Location: login.php?error=1");
                exit;
            }
        } catch (PDOException $e) {
            // Si ocurre un error en la consulta, mostrar el mensaje de error
            header("Location: login.php?error=2");
        }

    } else {
        // Si el reCAPTCHA no es válido, redirigir a la página de login con un error
        header('Location: login.php?error=4'); // Redirigir si la validación del reCAPTCHA falla
        exit;
    }
   
} else {
    // Si se intenta acceder a este script sin una solicitud POST, redirigir a otra página (opcional)
    header("Location: login.php?error=2");
    exit;
}
?>
