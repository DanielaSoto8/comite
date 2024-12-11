<?php
require_once('../config/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../vendor/autoload.php');
session_start();


// Verificar si se enviaron los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $lugar = $_POST['lugar'] ?? '';
    $observacion = $_POST['observacion'] ?? '';
    $estado = 'Programado'; // Estado por defecto al crear el comité
    $id_grupo = $_POST['id_grupo'] ?? '';
    $informe_aprendices = $_POST['aprendices'];


    // Validar que los campos requeridos estén presentes
    if (empty($fecha_inicio) || empty($fecha_fin) || empty($lugar) || empty($observacion)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Insertar el comité en la base de datos
    $query = "INSERT INTO comite (fecha_inicio, fecha_fin, lugar, observacion, estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssss', $fecha_inicio, $fecha_fin, $lugar, $observacion, $estado);
        if (mysqli_stmt_execute($stmt)) {
            $id_comite = mysqli_insert_id($conn);

            // Obtener los datos de los aprendices de la tabla informe según el grupo
            /*$query_aprendices = "SELECT documento_aprendiz, correo_aprendiz, nombre_aprendiz FROM informe WHERE id_grupo = ?";
            $stmt_aprendices = mysqli_prepare($conn, $query_aprendices);
            mysqli_stmt_bind_param($stmt_aprendices, 's', $id_grupo);
            mysqli_stmt_execute($stmt_aprendices);
            $result = mysqli_stmt_get_result($stmt_aprendices);
            $aprendices = $result->fetch_all(MYSQLI_ASSOC);*/

            // Asignar los aprendices al comité
           
            $mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'educomitpro@gmail.com';
$mail->Password = 'pznn nraf izxa bybd'; // Usa tu contraseña de aplicación
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('educomitpro@gmail.com', 'Sistema de Comités');

// Establecer codificación UTF-8
$mail->CharSet = 'UTF-8';
$mail->ContentType = 'text/html; charset=UTF-8';

foreach ($informe_aprendices as $aprendiz) {
    $aprendiz = json_decode($aprendiz, true);
    $id_informe = $aprendiz['id'];

    $query_asignar = "INSERT INTO comite_informe (id_comite, id_informe) VALUES (?, ?)";
    $stmt_asignar = mysqli_prepare($conn, $query_asignar);
    mysqli_stmt_bind_param($stmt_asignar, 'is', $id_comite, $id_informe);
    mysqli_stmt_execute($stmt_asignar);

    try {
        $correo_aprendiz = $aprendiz['correo_aprendiz'];
        $nombre_aprendiz = $aprendiz['nombre_aprendiz'];
        $correo_instructor = $aprendiz['correo_instructor'];
        $nombre_instructor = $aprendiz['nombre_instructor'];
        $id_informe = $aprendiz['id'];

        $mail->addAddress($correo_aprendiz, $nombre_aprendiz);
        $mail->addAddress($correo_instructor, $nombre_instructor);

        $mail->Subject = 'Notificación de Comité';
        $mailContent = "
            <h2>Notificación de Comité</h2>
            <p>Estimado(a) $nombre_aprendiz,</p>
            Se le informa que tiene un comité programado dado el reporte # <strong>$id_informe</strong> el cual ya había sido notificado.
            <p><strong>En atención a lo anterior, le informo que usted tiene derecho a presentar sus descargos ante el Comité de Evaluación y Seguimiento del Centro, en forma escrita , así como a controvertir las pruebas allegadas o que se alleguen en su contra y a aportar y/o solicitar la práctica de las pruebas que considere pertinentes.
            Para la diligencia de presentación de descargos y de recepción de las pruebas, el Comité de Evaluación y seguimiento del Centro ha fijado el dia y hora  $fecha_inicio a $fecha_fin en $lugar 
            </strong></p>
            <p>Atentamente,</p>
            <p>La coordinación</p>
        ";

        $mail->isHTML(true);
        $mail->Body = $mailContent;  // No necesitas utf8_encode

        if (!$mail->send()) {
            $_SESSION["mensaje"] = "Error al enviar correo<br>";
        } else {
            $_SESSION["mensaje"] = "Correo enviado correctamente <br>";
        }

        $mail->clearAddresses();

        $updateQuery = "UPDATE informe SET estado = 'Agendado' WHERE id = '$id_informe' ";
        mysqli_query($conn, $updateQuery);

        // Confirmación de éxito
        $_SESSION["mensaje"] = "El comité se ha creado correctamente y las notificaciones han sido enviadas.";
    } catch (Exception $e) {
        $_SESSION["mensaje"] = "Error al enviar las notificaciones: {$mail->ErrorInfo}";
    }
}


            // Configurar PHPMailer para enviar notificaciones

        } else {
            $_SESSION["mensaje"] = "Error al crear el comité: " . mysqli_error($conn);
        }
    } else {
        $_SESSION["mensaje"] = "Error en la preparación de la consulta: " . mysqli_error($conn);
    }
}

header("Location: comite.php");
exit();
?>