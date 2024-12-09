<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/sena.jpg" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- Script de reCAPTCHA -->

    <style>
        body {
            background-color: #2e7d32; /* Fondo verde oscuro */
            color: #fff; /* Texto blanco */
        }

        .recaptcha-center {
            display: flex;
            justify-content: center;
        }

        .card {
            background-color: #ffffff; /* Fondo blanco para el formulario */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-success {
            background-color: #1b5e20; /* Verde oscuro */
            border: none;
        }

        .btn-success:hover {
            background-color: #145a14; /* Más oscuro al pasar */
        }

        .imagen {
            width: 50px; /* Tamaño ajustado del logo */
            height: auto;
            margin-right: 10px;
        }

        .text-center a {
            color: #2e7d32; /* Verde para los enlaces */
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Login Content-->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <!-- Centrado del logo y título -->
                                    <div class="text-center d-flex align-items-center justify-content-center" style="height: 120px;">
                                        <img class="imagen" src="img/sena.png" alt="Logo SENA">
                                        <h1 class="h4 mb-0" style="color: #2e7d32; font-weight: bold;">EducomitPro</h1>
                                    </div>

                                    <form class="user" method="post" action="op_login.php">
                                        <div class="form-group">
                                            <input type="text" name="usuario" class="form-control" required placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="contrasenia" class="form-control" required placeholder="Contraseña">
                                        </div>
                                        <!-- Centrado de reCAPTCHA -->
                                        <div class="form-group recaptcha-center">
                                            <div class="g-recaptcha" data-sitekey="6LdiH3IqAAAAAFRFc8l3U6WPKozYgEB1Mb6onLHb"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-block" value="Iniciar Sesión">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="recuperar_contrasenia.php">¿Olvidaste tu contraseña?</a>
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
