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
    $estado = 'Pendiente'; // Estado por defecto es "Pendiente"

    // Validar que todos los campos estén completos
    if (empty($fecha_informe) || empty($documento_aprendiz) || empty($nombre_aprendiz) || empty($correo_aprendiz) || empty($programa_formacion) || empty($id_grupo) || empty($reporte) || empty($documento_instructor) || empty($nombre_instructor) || empty($correo_instructor)) {
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        header('Location: informe.php');
        exit;
    }

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO informe (fecha_informe, documento_aprendiz, nombre_aprendiz, correo_aprendiz, programa_formacion, id_grupo, reporte, documento_instructor, nombre_instructor, correo_instructor, estado) 
              VALUES (?,?,?,?,?,?,?,?,?,?,?)";
   $stmt = mysqli_prepare($conn, $query);
   mysqli_stmt_bind_param($stmt, 'sssssssssss', $fecha_informe, $documento_aprendiz, $nombre_aprendiz, $correo_aprendiz, $programa_formacion, $id_grupo, $reporte, $documento_instructor, $nombre_instructor, $correo_instructor, $estado);
   if (mysqli_stmt_execute($stmt)) {
       $id_informe = mysqli_insert_id($conn);

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
            $mail->Subject = 'Nuevo Informe';

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

    } else {
        $_SESSION['mensaje'] = 'Error al crear la notificación: ' . mysqli_error($conn);
    }

    // Redirigir al usuario de vuelta a la página principal
    header('Location: informe.php');
    exit;
}
?>