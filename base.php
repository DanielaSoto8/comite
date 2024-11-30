<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Enlace a los estilos de Font Awesome y Bootstrap -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <button onclick="window.location.href='aprendices.php'" class="btn btn-primary btn-lg mx-3">
        <i class="fas fa-user-graduate"></i> Aprendices
    </button>
    <button onclick="window.location.href='instructores.php'" class="btn btn-secondary btn-lg mx-3">
        <i class="fas fa-chalkboard-teacher"></i> Instructores
    </button>
</div>


    <!-- Enlaces a los scripts de Bootstrap y jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
