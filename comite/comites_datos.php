<?php
require_once('../config/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $lugar = $_POST['lugar'];
    $observacion = $_POST['observacion'];
    $estado = $_POST['estado'];

    // Verificar que todos los campos estén completos
    if (empty($fecha_inicio) || empty($fecha_fin) || empty($lugar) || empty($observacion) || empty($estado)) {
        $_SESSION['mensaje'] = 'Todos los campos son obligatorios.';
        header('Location: comites.php');
        exit;
    }

    // Insertar el nuevo comité en la base de datos
    $query = "INSERT INTO comites (fecha_inicio, fecha_fin, lugar, observacion, estado) 
              VALUES ('$fecha_inicio', '$fecha_fin', '$lugar', '$observacion', '$estado')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = 'Comité creado exitosamente.';
        
        // Obtener los estudiantes con estado "pendiente"
        $query_estudiantes = "SELECT * FROM informe WHERE estado = 'Pendiente'";
        $result = mysqli_query($conn, $query_estudiantes);
        
        if (mysqli_num_rows($result) > 0) {
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'educomitpro@gmail.com';
                $mail->Password = 'pznn nraf izxa bybd';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('educomitpro@gmail.com', 'Sistema de Comités');
                $mail->Subject = 'Notificación de Comité';

                // Enviar correos a cada estudiante pendiente
                while ($row = mysqli_fetch_assoc($result)) {
                    $mail->addAddress($row['correo_aprendiz'], $row['nombre_aprendiz']);
                    $mailContent = "
                        <h2>Notificación de Comité</h2>
                        <p><strong>Fecha Inicio:</strong> $fecha_inicio</p>
                        <p><strong>Fecha Fin:</strong> $fecha_fin</p>
                        <p><strong>Lugar:</strong> $lugar</p>
                        <p><strong>Observación:</strong> $observacion</p>
                    ";
                    $mail->Body = $mailContent;

                    // Enviar el correo
                    $mail->send();
                    // Limpiar las direcciones antes de enviar el siguiente correo
                    $mail->clearAddresses();
                }
                $_SESSION['mensaje'] = 'Correos enviados correctamente a los estudiantes.';
            } catch (Exception $e) {
                $_SESSION['mensaje'] = 'Error al enviar los correos: ' . $mail->ErrorInfo;
            }
        } else {
            $_SESSION['mensaje'] = 'No se encontraron estudiantes pendientes.';
        }

    } else {
        $_SESSION['mensaje'] = 'Error al crear el comité: ' . mysqli_error($conn);
    }

    header('Location: comites.php');
    exit;
}
?>

<?php
require_once('../config/config.php');

// Obtener los registros de estudiantes con estado "pendiente"
$query = "SELECT * FROM informe WHERE estado = 'Pendiente'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Comités</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Encabezado -->
            <div class="card shadow mb-4 bg-green-100">
                <div class="card-header py-3 bg-green-600 text-white">
                    <h4 class="m-0 font-weight-bold">Gestión de Comités</h4>
                </div>
                <div class="card-body">
                    <p>Administra los comités existentes y envía notificaciones a los aprendices.</p>
                </div>
            </div>

            <!-- Tabla de estudiantes pendientes -->
            <div class="card mt-4 bg-green-100">
                <div class="card-header bg-green-600 text-white">
                    <h4>Estudiantes Pendientes</h4>
                </div>
                <div class="card-body">
                    <table id="estudiantesPendientes" class="table table-bordered table-hover">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['documento_aprendiz']; ?></td>
                                    <td><?php echo $row['nombre_aprendiz']; ?></td>
                                    <td><?php echo $row['correo_aprendiz']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#estudiantesPendientes').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
            }
        });
    });
</script>

</body>
</html>
