<?php
require_once('../config/config.php');
session_start();

// Mostrar mensajes
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    $tipo = (strpos($mensaje, 'Error') !== false) ? 'error' : 'success';
    echo "
    <div id='modal' class='fixed inset-0 bg-opacity-50 flex justify-center items-center z-50'>
        <div class='bg-white rounded-lg p-6 w-96'>
            <h3 class='text-lg font-bold text-" . ($tipo === 'error' ? 'red' : 'green') . "-700'>$mensaje</h3>
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
    <title>Gestión de Notificaciones</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Encabezado -->
                <div class="card shadow mb-4 bg-green-100">
                    <div class="card-header py-3 bg-green-600 text-white">
                        <h4 class="m-0 font-weight-bold">Gestión de Notificaciones</h4>
                    </div>
                    <div class="card-body">
                        <p>Administra los comités existentes y envía notificaciones a los aprendices.</p>
                    </div>
                </div>

                <!-- Botón para abrir el modal -->
                <button type="button" class="btn bg-green-600 hover:bg-green-700 text-white" data-toggle="modal"
                    data-target="#modalCrearComite">
                    <i class="fas fa-plus-circle"></i> Crear Notificaciones
                </button>

                <!-- Modal para crear comité -->
                <div class="modal fade" id="modalCrearComite" tabindex="-1" aria-labelledby="modalCrearComiteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-green-600 text-white">
                                <h5 class="modal-title" id="modalCrearComiteLabel">Crear Notificación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="crear_informe.php" method="POST">
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
                                            name="nombre_aprendiz" required>
                                    </div>
                                    <!-- Correo del Aprendiz -->
                                    <div class="form-group">
                                        <label for="correo_aprendiz">Correo del Aprendiz</label>
                                        <input type="email" class="form-control" id="correo_aprendiz"
                                            name="correo_aprendiz" required>
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
                                        <input type="text" class="form-control" id="id_grupo" name="id_grupo" required>
                                    </div>
                                    <!-- Descripción del Reporte -->
                                    <div class="form-group">
                                        <label for="reporte">Reporte</label>
                                        <textarea class="form-control" id="reporte" name="reporte" required></textarea>
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
                                            name="nombre_instructor" required>
                                    </div>
                                    <!-- Correo del Instructor -->
                                    <div class="form-group">
                                        <label for="correo_instructor">Correo del Instructor</label>
                                        <input type="email" class="form-control" id="correo_instructor"
                                            name="correo_instructor" required>
                                    </div>
                                    <!-- Estado del Comité -->
                                    <div class="form-group">
                                        <label for="estado_comite">Estado del Comité</label>
                                        <select class="form-control" id="estado_comite" name="estado_comite" required>
                                            <option value="Programado">Programado</option>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="Completado">Completado</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit"
                                            class="btn bg-green-600 hover:bg-green-700 text-white">Crear</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="card mt-4 bg-green-100">
                    <div class="card-header bg-green-600 text-white">
                        <h4>Comités Actuales</h4>
                    </div>
                    <div class="card-body">
                        <table id="informe" class="table table-bordered table-hover">
                            <thead class="bg-green-500 text-white">
                                <tr>
                                    <th>Fecha del Informe</th>
                                    <th>Documento del Aprendiz</th>
                                    <th>Nombre del Aprendiz</th>
                                    <th>Correo del Aprendiz</th>
                                    <th>Programa de Formación</th>
                                    <th>ID del Grupo</th>
                                    <th>Reporte</th>
                                    <th>Documento del Instructor</th>
                                    <th>Nombre del Instructor</th>
                                    <th>Correo del Instructor</th>
                                    <th>Estado del Comité</th>
                                    <th>Acciones</th>
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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#comites').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                }
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
                    document.getElementById('nombre_aprendiz').value =  `${ aprendiz.nombres} ${aprendiz.apellidos}`;
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
                    document.getElementById('nombre_instructor').value = `${ instructor.nombres} ${instructor.apellidos}`;
                    document.getElementById('correo_instructor').value = instructor.correo_electronico;
                    sugerenciasInstructor.classList.add('hidden');
                });
                sugerenciasInstructor.appendChild(li);
            });
        }
    </script>
</body>

</html>