<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2e7d32; /* Fondo verde oscuro */
            color: #fff; /* Texto blanco */
        }
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-success {
            background-color: #1b5e20;
            border: none;
        }
        .btn-success:hover {
            background-color: #145a14;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-dark mb-4">Recuperar Contraseña</h3>
                        <form action="procesar_recuperacion.php" method="POST">
                        <div class="form-group">
                                <label for="usuario" class="text-dark">Usuario</label>
                                <input type="usuario" name="usuario" id="usuario" class="form-control" required placeholder="Ingresa tu usuario">
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success btn-block">Enviar Enlace</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login.php" class="text-success">Volver al Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
