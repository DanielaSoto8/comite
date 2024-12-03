<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Enlace a los estilos de Font Awesome y Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-green-100">
    <div class="container-fluid h-screen flex justify-center items-center">
        <button onclick="window.location.href='aprendiz.php'" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transform transition-all duration-300 mx-3">
            <i class="fas fa-user-graduate"></i> Aprendices
        </button>
        <button onclick="window.location.href='instructores.php'" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transform transition-all duration-300 mx-3">
            <i class="fas fa-chalkboard-teacher"></i> Instructores
        </button>
    </div>

    <!-- Enlaces a los scripts de Bootstrap y jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
