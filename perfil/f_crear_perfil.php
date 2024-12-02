<!DOCTYPE html>
<html>
<head>
    <title>Crear Perfil</title>
</head>
<body>
    <h2>Crear Nuevo Perfil</h2>
    <form id="crearPerfilForm" method="post" action="op_crear_perfil.php">
        <label for="perfil">Perfil:</label>
        <input type="text" name="perfil" required><br><br>
        
        <label for="lectura">Lectura:</label>
        <input type="checkbox" id="lecturaCheckbox" name="lectura" value="1"><br><br>
        
        <label for="escritura">Escritura:</label>
        <input type="checkbox" id="escrituraCheckbox" name="escritura" value="1"><br><br>
        
        <label for="administracion">Administración:</label>
        <input type="checkbox" id="administracionCheckbox" name="administracion" value="1"><br><br>
        
        <label for="detalles">Detalles:</label><br>
        <textarea name="detalles" rows="4" cols="50"></textarea><br><br>
        
        <input type="submit" value="Crear Perfil">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cuando se cambia el estado de la casilla de verificación de lectura o escritura
            $("#lecturaCheckbox, #escrituraCheckbox").change(function() {
                // Si ambas casillas de verificación están marcadas, habilitar la casilla de administración
                if ($("#lecturaCheckbox").prop("checked") && $("#escrituraCheckbox").prop("checked")) {
                    $("#administracionCheckbox").prop("disabled", false);
                } else {
                    // Si alguna de las casillas de verificación no está marcada, deshabilitar la casilla de administración
                    $("#administracionCheckbox").prop("checked", false).prop("disabled", true);
                }
            });
        });
    </script>
</body>
</html>
