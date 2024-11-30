<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Enlace a los estilos de Font Awesome, Bootstrap y DataTables -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <!-- Estilos de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- Contenedor principal -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Encabezado principal -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Reporte Aprendices</h4>
                    </div>
                    <div class="card-body">
                        <p>A continuacion podras evidenciar los aprendices reportados a Comite Estudiantil y adicional
                            tendras la opcion para realizar un nuevo registro</p>
                    </div>
                </div>

                <!-- Botón para ir a agregar datos -->
                <!-- Formulario de búsqueda -->
                <div class="mb-4">
                    <h4>Buscar Registros</h4>
                    <form action="buscar.php" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="buscar" class="sr-only">Ingrese su busqueda</label>
                            <input type="text" id="buscar" name="buscar" class="form-control"
                                placeholder="Buscar por nombre" required>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                        </form>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalIngresarAprendiz">
                            <i class="fas fa-plus-circle"></i> Ingresar Aprendiz
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalIngresarAprendiz" tabindex="-1"
                            aria-labelledby="modalIngresarAprendizLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalIngresarAprendizLabel">Ingresar Aprendiz</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="procesar_formularioAprendices.php" method="POST">
                                            <div class="form-group">
                                                <label for="Nombres">Nombre</label>
                                                <input type="text" class="form-control" id="Nombres" name="Nombres"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Apellidos">Apellidos</label>
                                                <input type="text" class="form-control" id="Apellidos" name="Apellidos"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Documento">Documento</label>
                                                <input type="text" class="form-control" id="Documento" name="Documento"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="correoElectronico">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="correoElectronico" name="correoElectronico"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="idGrupo">ID Grupo</label>
                                                <input type="text" class="form-control" id="idGrupo" name="idGrupo"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Jornada">Jornada</label>
                                                <select class="form-control" id="Jornada" name="Jornada" required>
                                                    <option value="Mañana">Mañana</option>
                                                    <option value="Tarde">Tarde</option>
                                                    <option value="Noche">Noche</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                        <?php
include("procesar_formularioAprendices.php");

if (!empty($mensaje)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalMensaje = new bootstrap.Modal(document.getElementById('modalMensaje'));
            modalMensaje.show();
        });
    </script>
<?php endif; ?>

                                        
    

                                    </div>
                                </div>
                            </div>

                        </div>
                </div>

                <!-- Tabla de registros -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-primary">Registros Almacenados</h4>
                    </div>
                    <div class="card-body">
                        <table id="tablaAprendices" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Documento</th>
                                    <th>Correo electronico</th>
                                    <th>Id Grupo </th>
                                    <th>Jornada</th>
                                    <th>Acciones</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Incluye el archivo PHP donde se consulta la base de datos y se muestran los registros
                                include 'aprendices_datos.php';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a los scripts de Bootstrap, jQuery, Ruang Admin y DataTables -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <!-- Script de DataTables -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inicializa DataTables con opciones de búsqueda y ordenamiento
            $('#tablaAprendices').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                },
                "order": [[1, 'asc']]  // Orden por nombre del aprendiz (segunda columna)
            });
        });
    </script>
    <!-- Scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>