<?php
require_once('../config/config.php');

// Recoger los datos del formulario
$grupo_id = $_POST['grupo_id'];
$selected_aprendices = $_POST['selected_aprendices'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$lugar = $_POST['lugar'];
$observacion = $_POST['observacion'];
$estado = $_POST['estado'];

// Enviar los correos a los aprendices seleccionados
foreach ($selected_aprendices as $documento_aprendiz) {
    // Obtener el correo del aprendiz
    $query = "SELECT correo_aprendiz FROM informe WHERE documento_aprendiz = '$documento_aprendiz'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $correo_aprendiz = $row['correo_aprendiz'];

    // Enviar el correo
    $asunto = "Notificación de Comité";
    $mensaje = "Estimado aprendiz,\n\nSe ha creado un nuevo comité con la siguiente información:\n\n";
    $mensaje .= "Fecha de inicio: $fecha_inicio\n";
    $mensaje .= "Fecha de fin: $fecha_fin\n";
    $mensaje .= "Lugar: $lugar\n";
    $mensaje .= "Observación: $observacion\n";
    $mensaje .= "Estado: $estado\n\n";
    $mensaje .= "Saludos,\n\nEquipo de Gestión de Comités";
    $headers = "From: admin@tusistema.com";

    mail($correo_aprendiz, $asunto, $mensaje, $headers);
}

// Redirigir al usuario a una página de éxito
header("Location: comite.php");
exit;
?>
