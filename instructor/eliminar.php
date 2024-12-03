<?php
// Definir los valores para la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comite";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado el parámetro 'documento' para eliminar el registro
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Preparar la consulta para eliminar el registro
    $sql = "DELETE FROM instructor WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $documento);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        // Mensaje de éxito
        echo "<script>alert('Registro eliminado con éxito'); window.location.href = 'instructor.php';</script>";
    } else {
        // Mensaje de error
        echo "<script>alert('Error al eliminar el registro. Por favor, intente nuevamente.'); window.location.href = 'instructor.php';</script>";
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
} else {
    // Si no se recibe el parámetro 'documento', redirigir a la página principal
    echo "<script>alert('No se ha especificado un documento válido.'); window.location.href = 'aprendiz.php';</script>";
}

// Cerrar la conexión
$conn->close();
?>
