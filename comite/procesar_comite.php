<?php
require_once('../config/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Datos del formulario
$id_grupo = $_POST['id_grupo'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$lugar = $_POST['lugar'];

// Crear la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "comite");

// Verifica si hay error en la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los datos de los aprendices de la tabla informe
$query = "SELECT correo_aprendiz, nombre_aprendiz FROM informe WHERE id_grupo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id_grupo);
$stmt->execute();
$result = $stmt->get_result();
$selected_aprendices = $result->fetch_all(MYSQLI_ASSOC);

// Configuración de PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'educomitpro@gmail.com';
    $mail->Password = 'pznn nraf izxa bybd'; // Usa tu contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('educomitpro@gmail.com', 'Sistema de Comités');

    // Enviar correo a cada aprendiz
    foreach ($selected_aprendices as $aprendiz) {
        $to = $aprendiz['correo_aprendiz'];
        $name = $aprendiz['nombre_aprendiz'];

        $mail->addAddress($to);

        $mail->Subject = 'Notificación de Comité';
        $mailContent = "
            <h2>Notificación de Comité</h2>
            <p>Estimado(a) $name,</p>
            <p>Se le informa que tiene un comité programado:</p>
            <p><strong>Fecha:</strong> $fecha_inicio a $fecha_fin</p>
            <p><strong>Lugar:</strong> $lugar</p>
            <p>Atentamente,</p>
            <p>La coordinación</p>
        ";
        $mail->isHTML(true);
        $mail->Body = $mailContent;

        if (!$mail->send()) {
            echo "Error al enviar correo a $to<br>";
        } else {
            echo "Correo enviado correctamente a $to<br>";
        }

        // Limpia los destinatarios
        $mail->clearAddresses();
    }
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

$conn->close();
?>
