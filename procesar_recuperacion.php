<?php
require_once(__DIR__ . '/config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Verificar si el correo existe en la base de datos
    $query = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expira en 1 hora

        // Guardar el token en la base de datos
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        $query = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $query->bind_param("iss", $userId, $token, $expiry);
        $query->execute();

        // Enviar el correo
        $resetLink = "http://tu_dominio.com/restablecer_contrasenia.php?token=$token";
        $subject = "Restablecimiento de contraseña";
        $message = "Hola,\n\nHaz clic en el siguiente enlace para restablecer tu contraseña:\n\n$resetLink\n\nEste enlace expirará en 1 hora.";
        $headers = "From: soporte@tu_dominio.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Enlace enviado a tu correo.";
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
?>
