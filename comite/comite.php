<?php
require_once('../config/config.php');

include('../config/modal.php');

// Consulta SQL para obtener solo los aprendices con estado 'Notificado'
$query = "SELECT id, documento_aprendiz, nombre_aprendiz, correo_aprendiz, id_grupo, programa_formacion,nombre_instructor, correo_instructor FROM informe WHERE estado = 'Notificado'";

// Ejecutar la consulta
$result = mysqli_query($conn, $query);

// Verificar si hay errores en la consulta
if (!$result) {
    die("Error en la consulta: " . mysqli_error($mysqli));
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Comités</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50">

    <?php include('../config/sidebar.php'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include('../config/topbar.php'); ?>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- Encabezado -->
                    <div class="card shadow mb-4 bg-green-100">
                        <div class="card-header py-3 bg-green-600 text-white">
                            <h4 class="m-0 font-weight-bold">Gestión de Comités</h4>
                        </div>
                        <div class="card-body">
                            <p>Administra los comités existentes y envía notificaciones a los aprendices.</p>
                        </div>
                    </div>

                    <!-- Tabla de estudiantes pendientes -->
                    <div class="card mt-4 bg-green-100">
                        <div class="card-header bg-green-600 text-white">
                            <h4>Estudiantes Notificados</h4>
                        </div>
                        <div class="card-body">
                            <form action="crear_comite.php" method="POST">
                                <table id="estudiantesPendientes" class="table table-bordered table-hover">
                                    <thead class="bg-green-500 text-white">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="select_all" onclick="toggleCheckboxes()">
                                                Seleccionar Todos
                                            </th>
                                            <th>Id Informe</th>
                                            <th>Documento</th>
                                            <th>Nombre Aprendiz</th>
                                            <th>Correo Aprendiz</th>
                                            <th>ID Grupo</th>
                                            <th>Programa de Formación</th>
                                            <th>Nombre Instructor</th>
                                            <th>Correo Instructor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_aprendices[]"
                                                        value="<?php echo htmlspecialchars(json_encode($row)); ?>">
                                                </td>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['documento_aprendiz']; ?></td>
                                                <td><?php echo $row['nombre_aprendiz']; ?></td>
                                                <td><?php echo $row['correo_aprendiz']; ?></td>
                                                <td><?php echo $row['id_grupo']; ?></td>
                                                <td><?php echo $row['programa_formacion']; ?></td>
                                                <td><?php echo $row['nombre_instructor']; ?></td>
                                                <td><?php echo $row['correo_instructor']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Crear
                                    Comité</button>
                            </form>
                        </div>
                    </div>

                    <!-- Botón para abrir el modal -->
                    <button type="button"
                                        class="btn bg-green-500 hover:bg-green-600 text-white d-flex align-items-center"
                                        data-toggle="modal" data-target="#modalCrearComite">
                                        <i class="fas fa-plus-circle"></i> Crear comité
                                    </button>

                    <!-- Modal para crear comité -->
                    <div class="modal fade" id="modalCrearComite" tabindex="-1" aria-labelledby="modalCrearComiteLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-green-600 text-white">
                                    <h5 class="modal-title" id="modalCrearComiteLabel">Crear Comité</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para crear comité -->
                                    <form action="procesar_comite.php" method="POST">
                                        <!-- Tabla de estudiantes -->
                                        <h5>Seleccionar Aprendices</h5>
                                        <table id="estudiantesPendientes" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select_all"
                                                            onclick="toggleCheckboxes()"> Seleccionar Todos</th>}
                                                    <th>Id Informe</th>
                                                    <th>Documento</th>
                                                    <th>Nombre Aprendiz</th>
                                                    <th>Correo Aprendiz</th>
                                                    <!-- Otras columnas si son necesarias -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected_aprendices[]"
                                                                value="<?php echo htmlspecialchars(json_encode($row)); ?>">
                                                        </td>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['documento_aprendiz']; ?></td>
                                                        <td><?php echo $row['nombre_aprendiz']; ?></td>
                                                        <td><?php echo $row['correo_aprendiz']; ?></td>
                                                        <!-- Otras columnas si son necesarias -->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- Campos del formulario para crear comité -->
                                        <h5>Información del Comité</h5>
                                        <div class="form-group">
                                            <label for="fecha_inicio">Fecha de Inicio</label>
                                            <input type="datetime-local" class="form-control" id="fecha_inicio"
                                                name="fecha_inicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha de Fin</label>
                                            <input type="datetime-local" class="form-control" id="fecha_fin"
                                                name="fecha_fin" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lugar">Lugar</label>
                                            <input type="text" class="form-control" id="lugar" name="lugar" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observacion">Observación</label>
                                            <textarea class="form-control" id="observacion" name="observacion"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" id="estado" name="estado" required>
                                                <option value="Programado">Programado</option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Completado">Completado</option>
                                            </select>
                                        </div>

                                        <!-- Botones del formulario -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="window.history.back()">Cancelar</button>
                                            <button type="submit"
                                                class="btn bg-green-600 hover:bg-green-700 text-white">Crear</button>
                                        </div>
                                    </form>

                                    <script>
                                        // Script para seleccionar/deseleccionar todos los checkboxes
                                        function toggleCheckboxes() {
                                            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                            const selectAll = document.getElementById('select_all');
                                            checkboxes.forEach(checkbox => {
                                                checkbox.checked = selectAll.checked;
                                            });
                                        }
                                    </script>
                                    < </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#estudiantesPendientes').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                }
            });
        });

        function toggleCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var selectAll = document.getElementById('select_all');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });
        }
        function cerrarModal() {
                window.location.href = 'comite.php'; // Redireccionar después de cerrar el modal
            }
    </script>
     <script src="../js/utils.js"></script>

</body>

</html>