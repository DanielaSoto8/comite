<?php
// Definir los valores para la conexión
require_once('../config/config.php');
// Verificar la conexión
session_start();

// Crear la conexión a la base de datos


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se envió el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'] ?? null;
    $correo_electronico = $_POST['correo_electronico'];
    $estado = $_POST['estado'];
    $documento = $_POST['documento'];

    // Actualizar los datos en la base de datos
    $update_sql = "UPDATE instructor SET nombres = ?, apellidos = ?, celular = ?, correo_electronico = ?, estado = ? WHERE documento = ?";
    $update_stmt = $conn->prepare($update_sql);

    // Asegúrate de pasar todos los parámetros en el orden correcto
    $update_stmt->bind_param("ssssss", $nombres, $apellidos, $celular, $correo_electronico, $estado, $documento);

    if ($update_stmt->execute()) {

        // Mensaje de éxito
        $_SESSION["mensaje"] = "Registro actualizado con éxito.";

    } else {
        // Mensaje de error
        $_SESSION["mensaje"] = "Error al actualizar el registro. Por favor, intente nuevamente.";

    }
}
header("Location: instructor.php");
$update_stmt->close();


// Cerrar la conexión
$conn->close();
?>