<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Asegúrate de tener PHPMailer instalado con Composer

// Datos de conexión
$servername = "localhost";
$username = "root";  // Usuario de MySQL en XAMPP (por defecto es "root")
$password = "";  // Contraseña de MySQL (por defecto en XAMPP es vacía)
$dbname = "comite";  // Cambia por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que no hay errores antes de guardar
    if (empty($errores)) {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO informes (fechaInforme, nombreAprendiz, documentoAprendiz, programaFormacion, idGrupo, descripcionQueja, testigosPruebas, correoQuejoso, nombreQuejoso, correoDocente, nombreDocente)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Enlazar los parámetros con los valores del formulario
            $stmt->bind_param("sssssssssss", $fechaInforme, $nombreAprendiz, $documentoAprendiz, $programaFormacion, $idGrupo, $descripcionQueja, $testigosPruebas, $correoQuejoso, $nombreQuejoso, $correoDocente, $nombreDocente);

            // Ejecutar la declaración y verificar si fue exitosa
            if ($stmt->execute()) {
                echo "<script>alert('Informe enviado correctamente.');</script>";

                // Enviar el correo electrónico con PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor SMTP/ ayuda al envio del correo
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Especifica el servidor SMTP (ej: smtp.gmail.com)
                    $mail->SMTPAuth = true;
                    $mail->Username = 'educomitpro@gmail.com';  // Tu correo
                    $mail->Password = 'pznn nraf izxa bybd';  // Tu contraseña de correo/aplicaciones externas usen contraseña personal
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;  // Puerto SMTP (587 para TLS o 465 para SSL)

                    // Destinatario
                    $mail->setFrom('educomitpro@gmail.com', 'Sistema de Quejas');
                    $mail->addAddress($correoQuejoso, $nombreQuejoso);
                    $mail->addAddress($correoDocente, $nombreDocente);

                    // Asunto del correo
                    $mail->Subject = 'Nuevo Informe o Queja';

                    // Contenido del correo en formato HTML
                    $mail->isHTML(true);
                    $mailContent = "
                    <h2>Notificación Comité</h2>
                    <p>Estimado(a) <strong><?php echo $nombreAprendiz; ?></strong>,</p>
                    <p>Con número de cédula <strong><?php echo $documentoAprendiz; ?></strong>, del grupo <strong><?php echo $idGrupo; ?></strong> y programa de formación <strong><?php echo $programaFormacion; ?></strong>, usted ha sido notificado por <strong><?php echo $descripcionQueja; ?></strong> por el instructor <strong><?php echo $nombreDocente; ?></strong>. Por favor, esté atento al agendamiento del comité.</p>

                    ";
                    $mail->Body = $mailContent;

                    // Enviar el correo
                    $mail->send();
                    echo "<script>alert('El informe ha sido enviado correctamente por correo.');</script>";
                } catch (Exception $e) {
                    echo "Error al enviar el informe por correo: {$mail->ErrorInfo}";
                }

            } else {
                echo "Error al guardar el informe: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la declaración: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>