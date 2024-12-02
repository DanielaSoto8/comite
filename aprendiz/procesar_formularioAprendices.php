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
    $nombres = $_POST['nombres'] ?? null;
    $apellidos = $_POST['apellidos'] ?? null;
    $celular = $_POST['celular'] ?? null;
    $documento = $_POST['documento'] ?? null;
    $correo_electronico = $_POST['correo_electronico'] ?? null;
    $id_grupo = $_POST['id_grupo'] ?? null;
    $jornada = $_POST['jornada'] ?? null;
    $estado = $_POST['estado'] ?? null;

    // Verificar si todos los campos están completos
    if ($nombres && $apellidos && $celular && $documento && $correo_electronico && $id_grupo && $jornada&& $estado) {
        $conexion = new mysqli('localhost', 'root', '', 'comite');

        // Preparar la consulta para insertar los datos en la base de datos
        $stmt = $conexion->prepare("INSERT INTO aprendiz (nombres, apellidos,celular, documento, correo_electronico, id_grupo, jornada, estado) VALUES (?, ?, ?, ?, ?,?,?,?)");
        $stmt->bind_param("sssss", $nombres, $apellidos, $documento, $celular, $correo_electronico, $id_grupo, $jornada, $estado);

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