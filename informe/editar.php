<?php
// Conexión a la base de datos
require_once('../config/config.php');

session_start();
// Verificar si se ha pasado el parámetro 'id' para editar el registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $fecha_informe = $_POST['fecha_informe'];
    $documento_aprendiz = $_POST['documento_aprendiz'];
    $nombre_aprendiz = $_POST['nombre_aprendiz'];
    $correo_aprendiz = $_POST['correo_aprendiz'];
    $programa_formacion = $_POST['programa_formacion'];
    $id_grupo = $_POST['id_grupo'];
    $reporte = $_POST['reporte'];
    $documento_instructor = $_POST['documento_instructor'];
    $nombre_instructor = $_POST['nombre_instructor'];
    $correo_instructor = $_POST['correo_instructor'];
    $estado = $_POST['estado'];

    //print_r($_POST);

    if (
        $fecha_informe && $documento_aprendiz && $nombre_aprendiz && $correo_aprendiz && $programa_formacion &&
        $id_grupo && $reporte && $documento_instructor && $nombre_instructor && $correo_instructor && $estado
    ) {
        // Actutalizar los datos
        try {
            $update_sql = "UPDATE `informe` SET `fecha_informe`= ?,`documento_aprendiz`= ?,`nombre_aprendiz`= ?,
            `correo_aprendiz`= ?,`programa_formacion`= ?,`id_grupo`= ?,`reporte`= ?,`documento_instructor`= ?,`nombre_instructor`= ?,`correo_instructor`= ?,
            `estado`= ? WHERE id = ? ";
            $update =$pdo->prepare($update_sql);
             $update->execute( [$fecha_informe, $documento_aprendiz, $nombre_aprendiz, $correo_aprendiz, 
            $programa_formacion, $id_grupo, $reporte, $documento_instructor, $nombre_instructor, $correo_instructor, $estado, $id]);
            $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Especifica el servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'educomitpro@gmail.com';  // Tu correo
            $mail->Password = 'pznn nraf izxa bybd';  // Tu contraseña de correo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;  // Puerto SMTP (587 para TLS)
    

            // Destinatarios
            $mail->setFrom('educomitpro@gmail.com', 'Sistema de Quejas');
            $mail->addAddress($correo_aprendiz, $nombre_aprendiz);
            $mail->addAddress($correo_instructor, $nombre_instructor);
            

            // Asunto del correo
            $mail->Subject = 'Actualización Informe';

            // Contenido del correo
            $mail->isHTML(true);
            // Asegúrate de que las variables tienen valores asignados antes de usarlas
            $mailContent = "
            <h2>Notificación de Informe: <strong>#{$id_informe}</strong> </h2>
            <p>Estimado(a) <strong>{$nombre_aprendiz}</strong>, Con número de cédula <strong>{$documento_aprendiz}</strong>, del grupo <strong>{$id_grupo}</strong> y programa de formación <strong>{$programa_formacion}</strong>, usted ha sido notificado por <strong>{$reporte}</strong> por el instructor <strong>{$nombre_instructor}</strong>. Por favor, esté atento al agendamiento del comité.</p>
            ";

            // Asignar el contenido al cuerpo del correo
            $mail->Body = $mailContent;

            // Configurar el formato del correo como HTML

            // Enviar el correo
            $mail->send();

            // Si el correo se envió correctamente, actualizar el estado en la base de datos
            $estado = 'Notificado';  // El estado se cambia a 'Notificado'
            $updateQuery = "UPDATE informe SET estado = '$estado' WHERE documento_aprendiz = '$documento_aprendiz' AND fecha_informe = '$fecha_informe'";
            mysqli_query($conn, $updateQuery);

            $_SESSION['mensaje'] = 'El informe ha sido enviado correctamente por correo.';
        } catch (Exception $e) {
            // Si ocurre un error al enviar el correo, el estado se mantiene como 'Pendiente'
            $_SESSION['mensaje'] = 'Error al enviar el informe por correo: ' . $mail->ErrorInfo;
        }

            $_SESSION['mensaje'] = 'Informe actualizado con éxito';

            // Redirigir al usuario a la página de inicio o cualquier página que desees
            header("Location: informe.php"); // Cambia esta URL por la que desees
            exit;

        } catch (exception $e) {
            $_SESSION['mensaje'] = "Error al actualizar el informe: " . $e->getMessage();
            header("Location: informe.php");
        }

    } else {
        $_SESSION['mensaje'] = "Error: todos los campos son requeridos: ";
        header("Location: informe.php");
    }
    $update_stmt->close();
} else {
    $_SESSION['mensaje'] = "Error: no se pudo procesar la solicitud: ";
    header("Location: informe.php");
}

?>