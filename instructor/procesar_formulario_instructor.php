<?php
$mensaje = "";
$mensajeTipo = ""; // 'success' o 'error'

// Datos de conexión
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "comite";  

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Se recomienda usar throw y catch en producción.
}


session_start();

// Procesar el formulario cuando se envíe (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $documento = $_POST['documento'] ?? null;
    $nombres = $_POST['nombres'] ?? null;
    $apellidos = $_POST['apellidos'] ?? null;
    $celular = $_POST['celular'] ?? null;
    $correo_electronico = $_POST['correo_electronico'] ?? null;
    $estado = $_POST['estado'] ?? null;

    // Verificar si todos los campos están completos
    if ($documento  && $nombres && $apellidos && $celular &&  $correo_electronico && $estado) {
        // Preparar la consulta para insertar los datos en la base de datos
        $stmt = $conn->prepare("INSERT INTO instructor ( documento,nombres, apellidos, celular,  correo_electronico,estado) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Vincular los parámetros correctamente (todos como strings, excepto celular que puede ser numérico)
        $stmt->bind_param("ssssss", $documento, $nombres, $apellidos, $celular, $correo_electronico, $estado);

        // Ejecutar la consulta e informar el resultado
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Registro guardado con éxito";
            header("Location: instructor.php");
            exit();
            //$mensaje = "Registro guardado con éxito.";
            //$mensajeTipo = "success";  // Color verde para éxito
        } else {
            $mensaje = "Error al guardar el registro: " . $stmt->error;
            $mensajeTipo = "error";    // Color rojo para error
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        $mensaje = "Por favor, completa todos los campos.";
        $mensajeTipo = "error"; // Color rojo para error
    }
}

// Cerrar la conexión
$conn->close();
?>

<!-- Mostrar mensaje de éxito o error con Tailwind CSS -->
<?php if ($mensaje): ?>
    <div class="max-w-xl mx-auto my-4 p-4 rounded-md 
        <?php echo $mensajeTipo == 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> 
        border border-solid border-<?php echo $mensajeTipo == 'success' ? 'green' : 'red'; ?>-400">
        <strong><?php echo $mensaje; ?></strong>
    </div>
<?php endif; ?>

