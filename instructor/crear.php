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
            $_SESSION["mensaje"] = "Error al guardar el registro: " . $stmt->error;
        
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        $_SESSION["mensaje"] = "Por favor, completa todos los campos.";

       
    }
}

// Cerrar la conexión
$conn->close();
?>



