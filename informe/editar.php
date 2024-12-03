<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comite";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informe</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Informe</h2>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
    <!-- Fecha del Informe -->
    <div class="form-group">
        <label for="fecha_informe">Fecha del Informe</label>
        <input type="datetime-local" class="form-control" id="fecha_informe" name="fecha_informe" 
               value="<?php echo date('Y-m-d\TH:i', strtotime($row['fecha_informe'])); ?>" required>
    </div>

    <!-- Documento del Aprendiz -->
    <div class="form-group">
        <label for="documento_aprendiz">Documento Aprendiz</label>
        <input type="text" class="form-control" id="documento_aprendiz" name="documento_aprendiz" 
               value="<?php echo htmlspecialchars($row['documento_aprendiz']); ?>" required autocomplete="off">
        <ul id="sugerencias" class="bg-white border border-gray-300 rounded shadow-lg absolute z-10 hidden max-h-48 overflow-auto"></ul>
        <div class="invalid-feedback">Campo obligatorio.</div>
    </div>

    <!-- Nombre del Aprendiz -->
    <div class="form-group">
        <label for="nombre_aprendiz">Nombre del Aprendiz</label>
        <input type="text" class="form-control" id="nombre_aprendiz" name="nombre_aprendiz" 
               value="<?php echo htmlspecialchars($row['nombre_aprendiz']); ?>" required>
    </div>

    <!-- Correo del Aprendiz -->
    <div class="form-group">
        <label for="correo_aprendiz">Correo del Aprendiz</label>
        <input type="email" class="form-control" id="correo_aprendiz" name="correo_aprendiz" 
               value="<?php echo htmlspecialchars($row['correo_aprendiz']); ?>" required>
    </div>

    <!-- Programa de Formación -->
    <div class="form-group">
        <label for="programa_formacion">Programa de Formación</label>
        <input type="text" class="form-control" id="programa_formacion" name="programa_formacion" 
               value="<?php echo htmlspecialchars($row['programa_formacion']); ?>" required>
    </div>

    <!-- ID del Grupo -->
    <div class="form-group">
        <label for="id_grupo">ID del Grupo</label>
        <input type="text" class="form-control" id="id_grupo" name="id_grupo" 
               value="<?php echo htmlspecialchars($row['id_grupo']); ?>" required>
    </div>

    <!-- Descripción del Reporte -->
    <div class="form-group">
        <label for="reporte">Reporte</label>
        <textarea class="form-control" id="reporte" name="reporte" required><?php echo htmlspecialchars($row['reporte']); ?></textarea>
    </div>

    <!-- Documento del Instructor -->
    <div class="form-group">
        <label for="documento_instructor">Documento Instructor</label>
        <input type="text" class="form-control" id="documento_instructor" name="documento_instructor" 
               value="<?php echo htmlspecialchars($row['documento_instructor']); ?>" required autocomplete="off">
        <ul id="sugerencias1" class="bg-white border border-gray-300 rounded shadow-lg absolute z-10 hidden max-h-48 overflow-auto"></ul>
        <div class="invalid-feedback">Campo obligatorio.</div>
    </div>

    <!-- Nombre del Instructor -->
    <div class="form-group">
        <label for="nombre_instructor">Nombre del Instructor</label>
        <input type="text" class="form-control" id="nombre_instructor" name="nombre_instructor" 
               value="<?php echo htmlspecialchars($row['nombre_instructor']); ?>" required>
    </div>

    <!-- Correo del Instructor -->
    <div class="form-group">
        <label for="correo_instructor">Correo del Instructor</label>
        <input type="email" class="form-control" id="correo_instructor" name="correo_instructor" 
               value="<?php echo htmlspecialchars($row['correo_instructor']); ?>" required>
    </div>

    <!-- Estado del Comité -->
    <div class="form-group">
        <label for="estado_comite">Estado del Comité</label>
        <select class="form-control" id="estado_comite" name="estado_comite" required>
            <option value="Programado" <?php echo ($row['estado_comite'] == 'Programado') ? 'selected' : ''; ?>>Programado</option>
            <option value="Pendiente" <?php echo ($row['estado_comite'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="Completado" <?php echo ($row['estado_comite'] == 'Completado') ? 'selected' : ''; ?>>Completado</option>
        </select>
    </div>

    <div class="modal-footer">
    <button type="submit" class="btn btn-success">Guardar Cambios</button>
    <a href="informe.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

    </div>
</body>

</html>
