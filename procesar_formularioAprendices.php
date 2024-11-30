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
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envíe (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombres'] ?? null;
    $apellidos = $_POST['Apellidos'] ?? null;
    $documento = $_POST['Documento'] ?? null;
    $correoElectronico = $_POST['correoElectronico'] ?? null;
    $jornada = $_POST['Jornada'] ?? null;

    // Verificar si todos los campos están completos
    if ($nombre && $apellidos && $documento && $correoElectronico && $jornada) {
        $conexion = new mysqli('localhost', 'root', '', 'comite');

        // Preparar la consulta para insertar los datos en la base de datos
        $stmt = $conexion->prepare("INSERT INTO aprendices (Nombres, Apellidos, Documento, correoElectronico, Jornada) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellidos, $documento, $correoElectronico, $jornada);

        // Ejecutar la consulta e informar el resultado
        if ($stmt->execute()) {
            $mensaje = "Registro guardado con éxito.";
            $mensajeTipo = "success";
        } else {
            $mensaje = "Error al guardar el registro: " . $stmt->error;
            $mensajeTipo = "error";
        }

        // Cerrar la sentencia y la conexión
        $stmt->close();
        $conexion->close();
    } else {
        $mensaje = "Por favor, completa todos los campos.";
        $mensajeTipo = "error";
    }
}
?>