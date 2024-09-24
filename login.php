<!-- <!-- <?php
            // Inicia la sesión
            //session_start();

            // Verifica si la sesión está iniciada
            //if (isset($_SESSION['id'])) {
            // Si la sesión está iniciada, redirige al index.php
            // header('Location: index.php');
            // exit(); // Importante: asegúrate de salir del script después de redirigir
            //}
            //
            ?>
<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="op_login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br><br>

        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia" required><br><br>

        <input type="submit" value="Iniciar Sesión">
        <a href="registrar.php">Nuevo usuario</a>
    </form>
</body>

</html> -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/SENA.PNG" rel="icon">
    <title>EduComitPro</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    
</head>

<body class="bg-gradient-login">
   <!-- Login Content-->
    
    <div class="container<!--  -->-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <img class="imagen" src="img/sena.png" alt="">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="post" action="op_login.php">
                                        <div class="form-group">
                                            <input type="text" name="usuario" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="contrasenia" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Iniciar Sesión">
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="register.html">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Login Content-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>