<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #2e7d32; /* Fondo verde oscuro */
            color: #fff; /* Texto blanco */
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #ffffff; /* Fondo blanco para el formulario */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-success {
            background-color: #1b5e20; /* Verde oscuro */
            border: none;
        }

        .btn-success:hover {
            background-color: #145a14; /* Más oscuro al pasar */
        }

        .text-center a {
            color: #2e7d32; /* Verde para los enlaces */
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .imagen {
            width: 50px; /* Tamaño ajustado del logo */
            height: auto;
            margin-right: 10px;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="card">
                <div class="card-body">
                    <div class="text-center d-flex align-items-center justify-content-center" style="height: 100px;">
                        <img class="imagen" src="img/sena.png" alt="Logo SENA">
                        <h1 class="h4 mb-0" style="color: #2e7d32; font-weight: bold;">EducomitPro</h1>
                    </div>

                    <form method="post" action="op_registrar.php" onsubmit="return validarContraseña()">
                        <div class="form-group">
                            <label for="usuario" style="color: black;">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                            <span id="usuario-disponibilidad"></span>
                        </div>

                        <div class="form-group">
                            <label for="nombres" style="color: black;">Nombres:</label>
                            <input type="text" name="nombres" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="apellidos" style="color:black;">Apellidos:</label>
                            <input type="text" name="apellidos" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="contrasenia" style="color: black;">Contraseña:</label>
                            <input type="password" id="contrasenia" name="contrasenia" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="repetir-contrasenia" style="color: black;">Repetir Contraseña:</label>
                            <input type="password" id="repetir-contrasenia" class="form-control" required>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" id="submit-btn" value="Registrar" class="btn btn-success" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validarContraseña() {
            var contrasenia = $('#contrasenia').val();
            if (!contrasenia || contrasenia.trim() === '') {
                alert("Por favor, introduce una contraseña válida.");
                return false; // Evitar que el formulario se envíe
            }

            var repetirContrasenia = $('#repetir-contrasenia').val();
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
