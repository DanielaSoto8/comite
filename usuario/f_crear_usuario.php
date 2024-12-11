<?php
// Conexión a la base de datos (ajusta los parámetros según tu configuración)
require_once('../config/config.php');

// Consulta para obtener los perfiles de la base de datos
$consulta_perfiles = $pdo->query("SELECT id, perfil FROM perfil");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen flex flex-col items-center p-6">
    <!-- Título -->
    <h2 class="text-3xl font-bold text-green-700 mb-6">Crear Nuevo Usuario</h2>

    <!-- Formulario -->
    <form method="post" action="op_crear_usuario.php" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">
        <!-- Campo Usuario -->
        <div class="mb-4">
            <label for="usuario" class="block text-green-700 text-sm font-bold mb-2">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <span id="usuario-disponibilidad" class="text-sm text-red-500 mt-1"></span>
        </div>

        <!-- Campo Contraseña -->
        <div class="mb-4">
            <label for="contrasenia" class="block text-green-700 text-sm font-bold mb-2">Contraseña:</label>
            <input type="password" name="contrasenia" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Nombres -->
        <div class="mb-4">
            <label for="nombres" class="block text-green-700 text-sm font-bold mb-2">Nombres:</label>
            <input type="text" name="nombres" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Apellidos -->
        <div class="mb-4">
            <label for="apellidos" class="block text-green-700 text-sm font-bold mb-2">Apellidos:</label>
            <input type="text" name="apellidos" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>
        <div class="mb-4">
            <label for="correo_electronico" class="block text-green-700 text-sm font-bold mb-2">Correo Electronico:</label>
            <input type="text" name="correo_electronico" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Perfil -->
        <div class="mb-4">
            <label for="id_perfil" class="block text-green-700 text-sm font-bold mb-2">Perfil:</label>
            <select name="id_perfil" required
                class="block appearance-none w-full bg-white border border-green-300 rounded py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Seleccione un perfil</option>
                <?php
                    // Recorrer los perfiles obtenidos y agregarlos como opciones en el select
                    while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['perfil']) . "</option>";
                    }
                ?>
            </select>

        </div>


        <!-- Campo Estado -->
        <div class="mb-4">
            <label for="estado" class="block text-green-700 text-sm font-bold mb-2">Estado:</label>
            <input type="text" name="estado" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Botón Crear -->
        <div class="flex items-center justify-between">
            <button type="submit" id="submit-btn"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Crear Usuario
            </button>
        </div>

    </form>

    <!-- Script de Validación -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var usuarioExistente = "";

            if ($('#usuario').val().trim() !== '') {
                usuarioExistente = $('#usuario').val().trim();
            }

            $('#usuario').keyup(function () {
                var nuevoUsuario = $(this).val().trim();

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