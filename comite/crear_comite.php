<?php
// Decodificar datos seleccionados
if (!empty($_POST['selected_aprendices'])) {
    $aprendices = array_map('json_decode', $_POST['selected_aprendices']);
} else {
    echo "No se seleccionaron aprendices.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Comité</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-green-600 {
            background-color: #047857 !important;
        }

        .hover\:bg-green-700:hover {
            background-color: #065f46 !important;
        }

        .text-white {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-4">Crear Comité</h3>
        <form action="guardar_comite.php" method="POST">
            <!-- Información del comité -->
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
            <div class="form-group">
                <label for="lugar">Lugar</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
            </div>
            <div class="form-group">
                <label for="observacion">Observación</label>
                <textarea class="form-control" id="observacion" name="observacion" required></textarea>
            </div>

            <!-- Lista de aprendices seleccionados -->
            <h5 class="mt-4">Aprendices Seleccionados:</h5>
            <ul class="list-group mb-4">
                <?php foreach ($aprendices as $aprendiz) { ?>
                    <li class="list-group-item">
                        <?php
                        echo htmlspecialchars($aprendiz->id) . " - " .
                            htmlspecialchars($aprendiz->nombre_aprendiz) . " - " .
                            htmlspecialchars($aprendiz->correo_aprendiz) . " (Grupo: " .
                            htmlspecialchars($aprendiz->id_grupo) . ")";
                        ?>
                        <input type="hidden" name="aprendices[]"
                            value="<?php echo htmlspecialchars(json_encode($aprendiz)); ?>">
                    </li>
                <?php } ?>
            </ul>

            <!-- Botones del formulario -->
            <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Crear Comité</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>