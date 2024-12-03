<?php
// Datos de conexión
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "comite";  

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de creación de comité
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $lugar = $_POST['lugar'];
    $observacion = $_POST['observacion'];
    $estado = $_POST['estado'];

    // Inserción del comité
    $stmt = $conn->prepare("INSERT INTO comite (fecha_inicio, fecha_fin, lugar, observacion, estado) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fecha_inicio, $fecha_fin, $lugar, $observacion, $estado);
    
    if ($stmt->execute()) {
        $comite_id = $stmt->insert_id;
        echo "Comité creado con éxito. ID: " . $comite_id;

        // Notificar a los informes en lista de espera
        notificarInformes($comite_id, $lugar, $fecha_inicio, $fecha_fin);
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

/**
 * Función para notificar a los usuarios de informes en espera
 */
function notificarInformes($comite_id, $lugar, $fecha_inicio, $fecha_fin) {
    global $conn;

    $query = "SELECT nombre_comite, correo_aprendiz FROM informe WHERE estado = 'en_espera'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($informe = $result->fetch_assoc()) {
            $mensaje = "Estimado/a " . $informe['nombre_comite'] . ",\n\n"
                     . "Se le informa que ha sido citado al comité con los siguientes detalles:\n"
                     . "Fecha de inicio: " . date("d-m-Y H:i", strtotime($fecha_inicio)) . "\n"
                     . "Fecha de fin: " . date("d-m-Y H:i", strtotime($fecha_fin)) . "\n"
                     . "Lugar: " . $lugar . "\n\n"
                     . "Por favor, confirme su asistencia respondiendo a este correo.\n";

            enviarCorreo($informe['correo_aprendiz'], "Notificación de Comité", $mensaje);
        }
    } else {
        echo "No hay informes en espera para notificar.\n";
    }
}

/**
 * Función para enviar correos electrónicos
 */
function enviarCorreo($destinatario, $asunto, $mensaje) {
    $headers = "From: comite@example.com\r\n";
    $headers .= "Reply-To: comite@example.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "Correo enviado a $destinatario.\n";
    } else {
        echo "Error al enviar el correo a $destinatario.\n";
    }
}
?>
