<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Comité</title>
</head>
<body>
    <h1>Crear Comité</h1>
    <form action="" method="POST">
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" required><br><br>

        <label for="fecha_fin">Fecha Fin:</label>
        <input type="datetime-local" id="fecha_fin" name="fecha_fin" required><br><br>

        <label for="lugar">Lugar:</label>
        <input type="text" id="lugar" name="lugar" required><br><br>

        <label for="observacion">Observación:</label>
        <textarea id="observacion" name="observacion" required></textarea><br><br>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="programado">Programado</option>
            <option value="cancelado">Cancelado</option>
        </select><br><br>

        <button type="submit">Crear Comité</button>
    </form>
</body>
</html>
