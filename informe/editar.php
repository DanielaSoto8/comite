<?php
// Conexión a la base de datos
require_once('../config/config.php');
// Verificar si se ha pasado el parámetro 'id' para editar el registro
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener los datos del informe con el id especificado
    $sql = "SELECT * FROM informe WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('No se encontró el registro con el ID especificado.'); window.location.href = 'informes.php';</script>";
        exit;
    }

    // Si se envió el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $nombre_aprendiz = $_POST['nombre_aprendiz'] ?? '';
        $documento = $_POST['documento'] ?? '';
        $programa = $_POST['programa'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $estado = $_POST['estado'] ?? '';

        if ($nombre_aprendiz && $documento && $programa && $descripcion && $estado) {
            // Actualizar los datos
            $update_sql = "UPDATE informe SET nombre_aprendiz = ?, documento = ?, programa = ?, descripcion = ?, estado = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("sssssi", $nombre_aprendiz, $documento, $programa, $descripcion, $estado, $id);

            if ($update_stmt->execute()) {
                echo "<script>alert('Registro actualizado con éxito'); window.location.href = 'informes.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el registro.');</script>";
            }
            $update_stmt->close();
        } else {
            echo "<script>alert('Todos los campos son obligatorios.');</script>";
        }
    }
} else {
    echo "<script>alert('ID no válido.'); window.location.href = 'informes.php';</script>";
}


?>