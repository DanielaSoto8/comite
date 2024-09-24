<!DOCTYPE html>
<html>

<head>
    <title>Crear Usuario</title>
</head>

<body>
    <h2>Crear Nuevo Usuario</h2>
    <form method="post" action="op_crear_usuario.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <span id="usuario-disponibilidad"></span><br>

        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia" required><br>

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label for="perfil">Perfil:</label>
        <select name="perfil" required>
            <option value="">Seleccione un perfil</option>
            <?php
            require_once ('config.php');
            $consulta_perfiles = $pdo->query("SELECT id, perfil FROM perfil");
            while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['perfil'] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" id="submit-btn" value="Crear Usuario">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var usuarioExistente = ""; // Variable para almacenar el usuario existente

            // Obtener el usuario existente si lo hay
            if ($('#usuario').val().trim() !== '') {
                usuarioExistente = $('#usuario').val().trim();
            }

            $('#usuario').keyup(function () {
                var nuevoUsuario = $(this).val().trim();

                // Verificar si el nuevo usuario es diferente al usuario existente y no está vacío
                if (nuevoUsuario !== usuarioExistente && nuevoUsuario !== '') {
                    $.ajax({
                        url: 'op_verificar_usuario.php',
                        type: 'post',
                        data: { usuario: nuevoUsuario },
                        dataType: 'json',
                        success: function (response) {
                            $('#usuario-disponibilidad').html(response.mensaje);
                            // Si el usuario existe, desactivar el botón de envío
                            if (response.existe) {
                                $('#submit-btn').prop('disabled', true);
                            } else {
                                $('#submit-btn').prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>