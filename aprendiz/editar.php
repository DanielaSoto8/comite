<?php
// Definir los valores para la conexión
require_once('../config/config.php');
// Verificar la conexión
session_start();
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $correo_electronico = $_POST['correo_electronico'];
    $programa_formacion = $_POST['programa_formacion'];
    $id_grupo = $_POST['id_grupo'];
    $jornada = $_POST['jornada'];
    $estado = $_POST['estado'];

    // Actualizar los datos en la base de datos
    $update_sql = "UPDATE aprendiz SET nombres = ?, apellidos = ?, celular = ?, correo_electronico = ?, id_grupo = ?, jornada = ?, programa_formacion = ?,  estado = ? WHERE documento = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssss", $nombres, $apellidos, $celular, $correo_electronico, $id_grupo, $jornada, $programa_formacion, $estado, $documento);

    if ($update_stmt->execute()) {
        // Mensaje de éxito
        $_SESSION["mensaje"] = "Registro actualizado con éxito";
    } else {
        $_SESSION["mensaje"] = "Error al actualizar el registro. Por favor, intente nuevamente.";
    }
    header("Location: aprendiz.php");
    $update_stmt->close();

} 

// Cerrar la conexión
$conn->close();
?>