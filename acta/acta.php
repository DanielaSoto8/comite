<?php
require_once('../config/config.php');

session_start();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    $tipo = (strpos($mensaje, 'Error') !== false) ? 'error' : 'success'; // Determina si el mensaje es de éxito o error
    echo "
    <div id='modal' class='fixed inset-0 bg-opacity-50 flex justify-center items-center z-50'>
        <div class='bg-white rounded-lg p-6 w-96'>
            <h3 class='text-lg font-bold text-$tipo-700'>$mensaje</h3>
            <button onclick='cerrarModal()' class='mt-4 px-4 py-2 bg-green-600 text-white rounded'>Cerrar</button>
        </div>
    </div>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaces a los scripts de Bootstrap, jQuery, Ruang Admin y DataTables -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <!-- Script de DataTables -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <title>Página Principal</title>
    <!-- Enlace a los estilos de Font Awesome, Bootstrap y DataTables -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <!-- Estilos de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Agregar Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-green-50">
    <?php include('../config/sidebar.php'); ?>
    <!-- Contenedor principal -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include('../config/topbar.php'); ?>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- Encabezado principal -->
                    <div class="card shadow mb-4 bg-green-100">
                        <div class="card-header py-3 bg-green-600 text-white">
                            <h4 class="m-0 font-weight-bold">Gestion de actas</h4>
                        </div>
                    </div>
                    <div class="card shadow mb-4 bg-green-100">
                        <div class="card-header py-3 bg-green-600 text-white mb-4 ">
                            <h4 class="m-0 font-weight-bold">Buscar registros</h4>
                            <!-- Formulario de búsqueda -->
                            <div class="mb-4">
                                <form action="buscar.php" method="GET" class="d-flex align-items-center gap-3">
                                    <!-- Campo de texto para búsqueda -->
                                    <div class="form-group mb-0 flex-grow-1">
                                        <label for="buscar" class="sr-only">Ingrese su búsqueda</label>
                                        <input type="text" id="buscar" name="buscar" class="form-control"
                                            placeholder="Buscar por nombre" required>
                                    </div>

                                    <!-- Botón de buscar -->
                                    <button type="submit"
                                        class="btn bg-green-500 hover:bg-green-600 text-white d-flex align-items-center">
                                        <i class="fas fa-search mr-1"></i> Buscar
                                    </button>

                                    <!-- Botón de ingresar instructor -->
                                    <button type="button"
                                        class="btn bg-green-500 hover:bg-green-600 text-white d-flex align-items-center"
                                        data-toggle="modal" data-target="#modalIngresarAprendiz">
                                        <i class="fas fa-plus-circle"></i> Nueva Acta comite
                                    </button>
                                </form>
                            </div>











                            <!-- Modal -->
                            <div class="modal fade" id="modalIngresarAprendiz" tabindex="-1"
                                aria-labelledby="modalIngresarAprendizLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-green-600 text-black">
                                            <h5 class="modal-title" id="modalIngresarAprendizLabel">Nueva Acta comite
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body bg-green-50 text-black">
                                            <form action="procesar_formularioAprendices.php" method="POST">
                                                <div class="form-group">
                                                    <label for="nombres">Nombre</label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellidos">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellidos"
                                                        name="apellidos" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular">Celular</label>
                                                    <input type="text" class="form-control" id="celular" name="celular"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="documento">Documento</label>
                                                    <input type="text" class="form-control" id="documento"
                                                        name="documento" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo_electronico">Correo Electrónico</label>
                                                    <input type="email" class="form-control" id="correo_electronico"
                                                        name="correo_electronico" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_grupo">ID Grupo</label>
                                                    <input type="text" class="form-control" id="id_grupo"
                                                        name="id_grupo" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jornada">Jornada</label>
                                                    <select class="form-control" id="jornada" name="jornada" required>
                                                    <option value="" disabled selected>Seleccionar J</option>
                                                        <option value="Mañana">Mañana</option>
                                                        <option value="Tarde">Tarde</option>
                                                        <option value="Noche">Noche</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="programa_formacion">Programa de formacion</label>
                                                    <input type="text" class="form-control" id="programa_formacion"
                                                        name="programa_formacion" required>
                                                </div>
                                                <div class="form-group">
                                                <label for="estado">Estado</label>
                                                <select class="form-control" id="estado" name="estado">
                                                    <option value="" disabled selected>Seleccionar Estado</option>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select>
                                            </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="submit"
                                                        class="btn bg-green-600 hover:bg-green-700 text-white">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de registros -->
                        <div class="card bg-green-100">
                            <div class="card-header bg-green-600 text-white">
                                <h4 class="m-0 font-weight-bold">Registros Almacenados</h4>
                            </div>
                            <div class="card-body bg-green-50">
                                <table id="aprendiz"
                                    class="table table-bordered table-striped table-hover text-gray-800">
                                    <thead class="bg-green-500 text-white">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Celular</th>
                                            <th>Documento</th>
                                            <th>Correo electrónico</th>
                                            <th>Id Grupo</th>
                                            <th>Jornada</th>
                                            <th>Programa formacion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Incluye el archivo PHP donde se consulta la base de datos y se muestran los registros
                                        include 'acta_datos.php';
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#aprendiz').DataTable({
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                            },
                            "order": [[1, 'asc']],  // Orden por nombre del aprendiz (segunda columna)
                            "searching": false      // Deshabilita el campo de búsqueda
                        });

                        // Asegúrate de que el modal esté oculto al inicio
                        $('#modalIngresarAprendiz').modal('hide');
                    });

                    function cerrarModal() {
                        window.location.href = 'aprendiz.php'; // Ocultar el modal
                        // Ocultar el modal
                    }
                </script>
                <script src="../js/utils.js"></script>

</body>

</html>