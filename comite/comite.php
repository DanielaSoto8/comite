<?php
require_once('../config/config.php');

session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header('Location: ../login.php');
    exit();
}

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
                                                    value="<?php echo htmlspecialchars(json_encode($row)); ?>"
                                                    data-aprendiz='<?php echo json_encode($row); ?>'>
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
                            <!--<button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Crear
                                    Comité</button>-->
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
                                    <form action="guardar_comite.php" method="POST">
                                        <!-- Información del comité -->
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

                                        <!-- Lista de aprendices seleccionados -->
                                        <h5 class="mt-4">Aprendices Seleccionados:</h5>
                                        <ul class="list-group mb-4" id="aprendices-list">
                                            <!-- Los aprendices seleccionados se agregarán dinámicamente aquí -->
                                        </ul>

                                        <!-- Botones del formulario -->
                                        <button type="submit"
                                            class="btn bg-green-600 hover:bg-green-700 text-white">Crear Comité</button>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                                    </form>


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
    <script>


        // Al hacer clic en el botón del modal, agregar los aprendices seleccionados
        $('#modalCrearComite').on('show.bs.modal', function () {
            var seleccionados = [];
            // Buscar todos los checkboxes seleccionados
            $('input[name="selected_aprendices[]"]:checked').each(function () {
                // Obtener el valor del checkbox (el objeto del aprendiz)
                var aprendiz = JSON.parse($(this).attr('data-aprendiz'));
                seleccionados.push(aprendiz);
            });

            // Limpiar la lista de aprendices en el modal
            var listaAprendices = $('#aprendices-list');
            listaAprendices.empty();

            // Agregar los aprendices seleccionados al modal
            seleccionados.forEach(function (aprendiz) {
                var item = $('<li>').addClass('list-group-item')
                    .text(aprendiz.nombre_aprendiz + ' (' + aprendiz.documento_aprendiz + ')');
                listaAprendices.append(item);

                // Crear un campo oculto con el aprendiz seleccionado
                var inputHidden = $('<input>').attr({
                    type: 'hidden',
                    name: 'aprendices[]',
                    value: JSON.stringify(aprendiz)
                });
                listaAprendices.append(inputHidden);
            });
        });

    </script>
    <script src="../js/utils.js"></script>

</body>

</html>