<?php
require_once('../config/config.php');
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión
    header('Location: ../login.php');
    exit();
}
// Mostrar mensajes
include('../config/modal.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Notificaciones</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                    <!-- Encabezado -->
                    <div class="card shadow mb-4 bg-green-100">
                        <div class="card-header py-3 bg-green-600 text-white">
                            <h4 class="m-0 font-weight-bold">Gestión de informes</h4>
                        </div>
                        <div class="card-body">
                            <p>Administra los informes existentes y envía notificaciones a los aprendices.</p>
                        </div>
                    </div>

                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn bg-green-600 hover:bg-green-700 text-white" data-toggle="modal"
                        data-target="#modalInforme">
                        <i class="fas fa-plus-circle"></i> Crear Notificaciones
                    </button>

                    <!-- Modal para crear comité -->
                    <div class="modal fade" id="modalInforme" tabindex="-1" aria-labelledby="modalInformeLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-green-600 text-white">
                                    <h5 class="modal-title" id="modalInformeLabel">Crear Notificación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="text" class="form-control" id="id" name="id" hidden>
                                        <!-- Fecha del Informe -->
                                        <div class="form-group">
                                            <label for="fecha_informe">Fecha del Informe</label>
                                            <input type="datetime-local" class="form-control" id="fecha_informe"
                                                name="fecha_informe" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="documento_aprendiz">Documento aprendiz</label>
                                            <input type="text" class="form-control" id="documento_aprendiz"
                                                name="documento_aprendiz" required autocomplete="off">
                                            <ul id="sugerencias"
                                                class="bg-white border border-gray-300 rounded shadow-lg absolute z-10 hidden max-h-48 overflow-auto">
                                            </ul>
                                            <div class="invalid-feedback">Campo obligatorio.</div>
                                        </div>

                                        <!-- Nombre del Aprendiz -->
                                        <div class="form-group">
                                            <label for="nombre_aprendiz">Nombre del Aprendiz</label>
                                            <input type="text" class="form-control" id="nombre_aprendiz"
                                                name="nombre_aprendiz" required readonly>
                                        </div>
                                        <!-- Correo del Aprendiz -->
                                        <div class="form-group">
                                            <label for="correo_aprendiz">Correo del Aprendiz</label>
                                            <input type="email" class="form-control" id="correo_aprendiz"
                                                name="correo_aprendiz" required readonly>
                                        </div>
                                        <!-- Programa de Formación -->
                                        <div class="form-group">
                                            <label for="programa_formacion">Programa de Formación</label>
                                            <input type="text" class="form-control" id="programa_formacion"
                                                name="programa_formacion" required>
                                        </div>
                                        <!-- ID del Grupo -->
                                        <div class="form-group">
                                            <label for="id_grupo">ID del Grupo</label>
                                            <input type="text" class="form-control" id="id_grupo" name="id_grupo"
                                                required>
                                        </div>
                                        <!-- Descripción del Reporte -->
                                        <div class="form-group">
                                            <label for="reporte">Reporte</label>
                                            <textarea class="form-control" id="reporte" name="reporte"
                                                required></textarea>
                                        </div>
                                        <!-- Documento del Instructor -->
                                        <div class="form-group">
                                            <label for="documento_instructor">Documento instructor</label>
                                            <input type="text" class="form-control" id="documento_instructor"
                                                name="documento_instructor" required autocomplete="off">
                                            <ul id="sugerencias-instructor"
                                                class="bg-white border border-gray-300 rounded shadow-lg absolute z-10 hidden max-h-48 overflow-auto">
                                            </ul>
                                            <div class="invalid-feedback">Campo obligatorio.</div>
                                        </div>
                                        <!-- Nombre del Instructor -->
                                        <div class="form-group">
                                            <label for="nombre_instructor">Nombre del Instructor</label>
                                            <input type="text" class="form-control" id="nombre_instructor"
                                                name="nombre_instructor" required readonly>
                                        </div>
                                        <!-- Correo del Instructor -->
                                        <div class="form-group">
                                            <label for="correo_instructor">Correo del Instructor</label>
                                            <input type="email" class="form-control" id="correo_instructor"
                                                name="correo_instructor" required readonly>
                                        </div>
                                        <!-- Estado del Comité -->
                                        <input type="hidden" name="estado" id="estado" value="Pendiente">

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

                    <!-- Tabla -->
                    <div class="card mt-4 bg-green-100">
    <div class="card-header bg-green-600 text-white">
        <h4>Informes Actuales</h4>
    </div>
    <div class="card-body">
        <div class="overflow-x-auto">
            <table id="informe" class="min-w-full table-auto border-separate border-spacing-0">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-2 border-b">Id</th>
                        <th class="px-4 py-2 border-b">Fecha del Informe</th>
                        <th class="px-4 py-2 border-b">Documento del Aprendiz</th>
                        <th class="px-4 py-2 border-b">Nombre del Aprendiz</th>
                        <th class="px-4 py-2 border-b">Correo del Aprendiz</th>
                        <th class="px-4 py-2 border-b">Programa de Formación</th>
                        <th class="px-4 py-2 border-b">ID del Grupo</th>
                        <th class="px-4 py-2 border-b">Reporte</th>
                        <th class="px-4 py-2 border-b">Documento del Instructor</th>
                        <th class="px-4 py-2 border-b">Nombre del Instructor</th>
                        <th class="px-4 py-2 border-b">Correo del Instructor</th>
                        <th class="px-4 py-2 border-b">Estado</th>
                        <th class="px-4 py-2 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'informe_datos.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
  $(document).ready(function () {
    $('#informe').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
        },
        "searching": false  // Esto deshabilita la barra de búsqueda
    });
});

        function cerrarModal() {
            window.location.href = 'informe.php';
        }
    </script>
    <script>

        // Función para activar las validaciones de Bootstrap
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        document.getElementById('documento_aprendiz').addEventListener('input', function () {
            const query = this.value;
            if (query.length > 3) {
                fetch(`./buscar_aprendiz.php?documento=${query}`)
                    .then(response => response.json())
                    .then(data => mostrarSugerenciasAprendiz(data))
                    .catch(error => console.error(error));
            } else {
                document.getElementById('sugerencias').classList.add('hidden');
            }
        });

        function mostrarSugerenciasAprendiz(data) {
            const sugerencias = document.getElementById('sugerencias');
            sugerencias.innerHTML = '';
            sugerencias.classList.remove('hidden');
            data.forEach(aprendiz => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-100');
                li.textContent = `${aprendiz.documento} - ${aprendiz.nombres} ${aprendiz.apellidos}`;
                li.addEventListener('click', function () {
                    document.getElementById('documento_aprendiz').value = aprendiz.documento;
                    document.getElementById('nombre_aprendiz').value = `${aprendiz.nombres} ${aprendiz.apellidos}`;
                    document.getElementById('correo_aprendiz').value = aprendiz.correo_electronico;
                    document.getElementById('id_grupo').value = aprendiz.id_grupo;
                    document.getElementById('programa_formacion').value = aprendiz.programa_formacion;
                    sugerencias.classList.add('hidden');
                });
                sugerencias.appendChild(li);
            });
        }
    </script>
    <script>
        document.getElementById('documento_instructor').addEventListener('input', function () {
            const query = this.value;
            if (query.length > 2) {
                fetch(`./buscar_instructor.php?documento=${query}`)
                    .then(response => response.json())
                    .then(data => mostrarSugerencias(data))
                    .catch(error => console.error(error));
            } else {
                document.getElementById('sugerencias-instructor').classList.add('hidden');
            }
        });

        function mostrarSugerencias(data) {
            const sugerenciasInstructor = document.getElementById('sugerencias-instructor');
            sugerenciasInstructor.innerHTML = '';
            sugerenciasInstructor.classList.remove('hidden');
            data.forEach(instructor => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-100');
                li.textContent = `${instructor.documento} - ${instructor.nombres} ${instructor.apellidos}`;
                li.addEventListener('click', function () {
                    document.getElementById('documento_instructor').value = instructor.documento;
                    document.getElementById('nombre_instructor').value = `${instructor.nombres} ${instructor.apellidos}`;
                    document.getElementById('correo_instructor').value = instructor.correo_electronico;
                    sugerenciasInstructor.classList.add('hidden');
                });
                sugerenciasInstructor.appendChild(li);
            });
        }
    </script>
    <script>
        $('#modalInforme').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var modal = $(this);

            if (button.hasClass('btn-editar')) {
                // Si es un botón de editar, configuramos el modal para editar
                modal.find('.modal-title').text('Editar Informe');
                modal.find('form').attr('action', 'editar.php');

                // Llenamos los campos con los datos del usuario
                modal.find('#id').val(button.data('id'));
                modal.find('#fecha_informe').val(button.data('fecha_informe'));
                modal.find('#documento_aprendiz').val(button.data('documento_aprendiz'));
                modal.find('#nombre_aprendiz').val(button.data('nombre_aprendiz'));
                modal.find('#correo_aprendiz').val(button.data('correo_aprendiz'));
                modal.find('#programa_formacion').val(button.data('programa_formacion'));
                modal.find('#id_grupo').val(button.data('id_grupo'));
                modal.find('#reporte').val(button.data('reporte'));
                modal.find('#documento_instructor').val(button.data('documento_instructor'));
                modal.find('#nombre_instructor').val(button.data('nombre_instructor'));
                modal.find('#correo_instructor').val(button.data('correo_instructor'));
                modal.find('#estado').val(button.data('estado'));



            } else {
                // Si es un botón de crear, configuramos el modal para crear
                modal.find('.modal-title').text('Ingresar Usuario');
                modal.find('form').attr('action', 'crear_informe.php');

                // Limpiamos los campos del formulario
                modal.find('#id').val(button.data(''));
                modal.find('#fecha_informe').val(button.data(''));
                modal.find('#documento_aprendiz').val(button.data(''));
                modal.find('#nombre_aprendiz').val(button.data(''));
                modal.find('#correo_aprendiz').val(button.data(''));
                modal.find('#programa_formacion').val(button.data(''));
                modal.find('#id_grupo').val(button.data(''));
                modal.find('#reporte').val(button.data(''));
                modal.find('#documento_instructor').val(button.data(''));
                modal.find('#nombre_instructor').val(button.data(''));
                modal.find('#correo_instructor').val(button.data(''));
                modal.find('#estado').val(button.data(''));
            }
        });
    </script>
    <script src="../js/utils.js"></script>

</body>

</html>