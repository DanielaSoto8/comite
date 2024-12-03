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

// Verificar si se ha pasado el parámetro 'documento' para editar el registro
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Obtener los datos del instructor con el documento especificado
    $sql = "SELECT * FROM instructor WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('No se encontró el registro con el documento especificado.'); window.location.href = 'instructor.php';</script>";
        exit;
    }

    // Si se envió el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir los datos del formulario
        $documento = $_POST['documento'] ?? null;
        $nombres = $_POST['nombres'] ?? null;
        $apellidos = $_POST['apellidos'] ?? null;
        $celular = $_POST['celular'] ?? null;
        $correo_electronico = $_POST['correo_electronico'] ?? null;
        $estado = $_POST['estado'] ?? null;

        // Actualizar los datos en la base de datos
        $update_sql = "UPDATE instructor SET docuemnto = ?, nombres = ?, apellidos = ?, celular = ?, correo_electronico = ?,  estado = ? WHERE documento = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssss", $documento, $nombres, $apellidos, $celular, $correo_electronico, $estado, );

        if ($update_stmt->execute()) {
            // Mensaje de éxito
            echo "<script>alert('Registro actualizado con éxito'); window.location.href = 'instructor.php';</script>";
        } else {
            // Mensaje de error
            echo "<script>alert('Error al actualizar el registro. Por favor, intente nuevamente.');</script>";
        }
        $update_stmt->close();
    }
} else {
    // Si no se pasa el parámetro 'documento', redirigir
    echo "<script>alert('No se ha especificado un documento válido.'); window.location.href = 'instructor.php';</script>";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Instructor</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container mt-5">
        <h2>Editar Registro del Instructor</h2>
        <form action="editar.php?documento=<?php echo $documento; ?>" method="POST">
        <div class="form-group">
                <label for="documento">Nombre</label>
                <input type="text" class="form-control" id="documento" name="documento"
                    value="<?php echo $row['documento']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nombres">Nombre</label>
                <input type="text" class="form-control" id="nombres" name="nombres"
                    value="<?php echo $row['nombres']; ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos"
                    value="<?php echo $row['apellidos']; ?>" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular"
                    value="<?php echo $row['celular']; ?>" required>
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico"
                    value="<?php echo $row['correo_electronico']; ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Activo" <?php echo ($row['estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="Inactivo" <?php echo ($row['estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="instructor.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</body>

</html>