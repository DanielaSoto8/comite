<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="op_registrar.php" onsubmit="return validarContraseña()">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <span id="usuario-disponibilidad"></span><br><br>

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br><br>

        <label for="contrasenia">Contraseña:</label>
        <input type="password" id="contrasenia" name="contrasenia" required><br><br>

        <label for="repetir-contrasenia">Repetir Contraseña:</label>
        <input type="password" id="repetir-contrasenia" required><br><br>

        <input type="submit" id="submit-btn" value="Registrar" disabled>
    </form>
    <script>
    function validarContraseña() {
        // Obtener el valor del campo de contraseña
        var contrasenia = $('#contrasenia').val();

        // Verificar si el campo de contraseña existe y no está vacío
        if (!contrasenia || contrasenia.trim() === '') {
            alert("Por favor, introduce una contraseña válida.");
            return false; // Evitar que el formulario se envíe
        }

        // Obtener el valor del campo de repetir contraseña
        var repetirContrasenia = $('#repetir-contrasenia').val();

        // Verificar si las contraseñas coinciden
        if (contrasenia.trim() !== repetirContrasenia.trim()) {
            alert("Las contraseñas no coinciden.");
            return false; // Evitar que el formulario se envíe
        }

        return true; // Permitir que el formulario se envíe si las contraseñas coinciden
    }

    $(document).ready(function () {
        var usuarioExistente = "";

        if ($('#usuario').val().trim() !== '') {
            usuarioExistente = $('#usuario').val().trim();
        }

        $('#usuario').keyup(function () {
            var nuevoUsuario = $(this).val().trim();
            console.log(nuevoUsuario);
            if (nuevoUsuario !== usuarioExistente && nuevoUsuario !== '') {
                $.ajax({
                    url: 'op_verificar_usuario.php',
                    type: 'post',
                    data: { usuario: nuevoUsuario },
                    dataType: 'json',
                    success: function (response) {
                        $('#usuario-disponibilidad').html(response.mensaje);
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