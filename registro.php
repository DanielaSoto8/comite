<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Enlace a los estilos de Font Awesome, Bootstrap y Ruang Admin -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>
<body>

    <!-- Contenedor principal -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Encabezado principal -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Bienvenido al Sistema</h4>
                    </div>
                    <div class="card-body">
                        <p>Utiliza las opciones a continuación para interactuar con el sistema.</p>
                    </div>
                </div>

                <!-- Botón para ir a agregar datos -->
                <div class="mb-4">
                    <button onclick="window.location.href='formulario.php'" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Ir a Agregar Datos
                    </button>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="mb-4">
                    <h4>Buscar Registros</h4>
                    <form action="buscar.php" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="buscar" class="sr-only">Buscar por nombre:</label>
                            <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar por nombre" required>
                        </div>
                        <button type="submit" class="btn btn-success mb-2">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </form>
                </div>

                <!-- Tabla de registros -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-primary">Registros Almacenados</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha del Informe</th>
                                    <th>Nombre del Aprendiz</th>
                                    <th>Documento del Aprendiz</th>
                                    <th>Programa de Formación</th>
                                    <th>ID del Grupo</th>
                                    <th>Descripción de la Queja</th>
                                    <th>Testigos/Pruebas</th>
                                    <th>Correo del Quejoso</th>
                                    <th>Nombre del Quejoso</th>
                                    <th>Correo del Docente</th>
                                    <th>Nombre del Docente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Incluye el archivo PHP donde se consulta la base de datos y se muestran los registros
                                    include 'mostrar_datos.php'; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a los scripts de Bootstrap, jQuery y Ruang Admin -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>
</html>
