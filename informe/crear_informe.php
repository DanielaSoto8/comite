<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../config/config.php');


session_start();
// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
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

    /*echo "fecha_informe".$fecha_informe;
    echo "documento_aprendiz".$documento_aprendiz;
    echo "nombre_aprendiz".$nombre_aprendiz;
    echo "correo_aprendiz".$correo_aprendiz;
    echo "programa_formacion".$programa_formacion;
    echo "id_grupo".$id_grupo;
    echo "reporte".$reporte;
    echo "documento_instructor".$documento_instructor;
    echo "nombre_instructor".$nombre_instructor;
    echo "correo_instructor".$correo_instructor;
    echo "estado".$estado;*/


    // Validar que todos los campos estén completos
    if (empty($fecha_informe) || empty($documento_aprendiz) || empty($nombre_aprendiz) || empty($correo_aprendiz) || empty($programa_formacion) || empty($id_grupo) || empty($reporte) || empty($documento_instructor) || empty($nombre_instructor) || empty($correo_instructor) || empty($estado)) {
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        header('Location: informe.php');
        exit;
    }

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO informe (fecha_informe, documento_aprendiz, nombre_aprendiz, correo_aprendiz, programa_formacion, id_grupo, reporte, documento_instructor, nombre_instructor, correo_instructor, estado) 
              VALUES ('$fecha_informe', '$documento_aprendiz', '$nombre_aprendiz', '$correo_aprendiz', '$programa_formacion', '$id_grupo', '$reporte', '$documento_instructor', '$nombre_instructor', '$correo_instructor', '$estado')";

    if (mysqli_query($conn, $query)) {

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
            $mail->addAddress($correo_aprendiz, $nombre_aprendiz);
            $mail->addAddress($correo_instructor, $nombre_instructor);
            
            // Asunto del correo
            $mail->Subject = 'Nuevo Informe o Queja';

            // Contenido del correo en formato HTML
            $mail->isHTML(true);
            $mailContent = "
            <h2>Nuevo Informe o Queja</h2>
            <p><strong>Fecha del Informe:</strong> $fecha_informe</p>
            <p><strong>Nombre del Aprendiz:</strong> $nombre_aprendiz</p>
            <p><strong>Documento de Identidad:</strong> $documento_aprendiz</p>
            <p><strong>Programa de Formación:</strong> $programa_formacion</p>
            <p><strong>ID del Grupo:</strong> $id_grupo</p>
            <p><strong>Descripción de la Queja:</strong> $reporte</p>
            <p><strong>Correo del Quejoso:</strong> $documento_instructor</p>
            <p><strong>Nombre del Quejoso:</strong> $nombre_instructor</p>
            <p><strong>Correo del Docente:</strong> $correo_instructor</p>
            ";
            $mail->Body = $mailContent;

            // Enviar el correo
            $mail->send();
            echo "<script>alert('El informe ha sido enviado correctamente por correo.');</script>";
        } catch (Exception $e) {
            echo "Error al enviar el informe por correo: {$mail->ErrorInfo}";
        }




        $_SESSION['mensaje'] = 'Notificación creada exitosamente.';
    } else {
        $_SESSION['mensaje'] = 'Error al crear la notificación: ' . mysqli_error($conn);
    }

    // Redirigir al usuario de vuelta a la página principal
    header('Location: informe.php');
    exit;
}
?>
