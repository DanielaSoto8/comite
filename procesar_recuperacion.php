<?php
require_once(__DIR__ . '/config/config.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$correoEnviado = false;
$errorEnvioCorreo = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $correo_electronico = "";

    // Verificar si el correo existe en la base de datos
    $query = $conn->prepare("SELECT usuario, correo_electronico FROM usuario WHERE usuario = ?");
    $query->bind_param("s", $usuario);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Obtener el ID del usuario
        $user = $result->fetch_assoc();
        $correo_electronico = $user['correo_electronico'];
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expira en 1 hora

        

        // Verificar si ya existe un registro con el mismo user_id y token
        $checkQuery = $conn->prepare("SELECT user_id FROM password_resets WHERE usuario = ?");
        $checkQuery->bind_param("s", $usuario);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();

        if ($checkResult->num_rows > 0) {
            // Si el registro ya existe, actualizamos el token y la fecha de expiración
            $updateQuery = $conn->prepare("UPDATE password_resets SET token = ?, expires_at = ? WHERE usuario = ?");
            $updateQuery->bind_param("ssi", $token, $expiry, $usuario);
            $updateQuery->execute();
        } else {
            // Si el registro no existe, insertamos uno nuevo
            $insertQuery = $conn->prepare("INSERT INTO password_resets (usuario, token, expires_at) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sss", $usuario, $token, $expiry);
            $insertQuery->execute();
        }

        // Configurar el correo con PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'educomitpro@gmail.com';
            $mail->Password = 'pznn nraf izxa bybd'; // Contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatario
            $mail->setFrom('educomitpro@gmail.com', 'Sistema de Recuperación');
            $mail->addAddress($correo_electronico);

            // Asunto y cuerpo del correo
            $mail->Subject = 'Recuperación de contraseña';
            $resetLink = "http://localhost:8080/restablecer_contrasenia.php?token=$token";
            $mail->isHTML(true);
            $mail->Body = "
                <p>Hola,</p>
                <p>Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el enlace a continuación para continuar:</p>
                <a href='$resetLink'>$resetLink</a>
                <p>Este enlace expirará en 1 hora.</p>
            ";

            $mail->send();

            $correoEnviado = true;
        } catch (Exception $e) {
            $errorEnvioCorreo = true;
        }
    } else {
        echo "El correo no está registrado.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Modal -->
    <div id="mensaje" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold mb-4">Información</h2>
            <p class="text-gray-700">
                <?php if ($correoEnviado): ?>
                    El correo de recuperación ha sido enviado a <strong><?php echo htmlspecialchars($correo_electronico); ?></strong> correctamente.
                <?php elseif ($errorEnvioCorreo): ?>
                    Hubo un error al enviar el correo. Inténtalo nuevamente más tarde.
                <?php endif; ?>
            </p>
            <div class="mt-6 text-right">
                <button onclick="window.location.href='./login.php'" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Aceptar</button>
            </div>
        </div>
    </div>
</body>
</html>


