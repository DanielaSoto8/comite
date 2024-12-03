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
    <title>Gestión de Comités</title>
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
                    <h4 class="m-0 font-weight-bold">Gestión de Comités</h4>
                </div>
                <div class="card-body">
                    <p>Administra los comités existentes y envía notificaciones a los aprendices.</p>
                </div>
            </div>

            <!-- Botón para abrir el modal -->
            <button type="button" class="btn bg-green-600 hover:bg-green-700 text-white" data-toggle="modal" data-target="#modalCrearComite">
                <i class="fas fa-plus-circle"></i> Crear Comité
            </button>

            <!-- Modal para crear comité -->
            <div class="modal fade" id="modalCrearComite" tabindex="-1" aria-labelledby="modalCrearComiteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-green-600 text-white">
                            <h5 class="modal-title" id="modalCrearComiteLabel">Crear Comité</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="procesar_comite.php" method="POST">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha Inicio</label>
                                    <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha Fin</label>
                                    <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                </div>
                                <div class="form-group">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="form-control" id="lugar" name="lugar" required>
                                </div>
                                <div class="form-group">
                                    <label for="observacion">Observación</label>
                                    <textarea class="form-control" id="observacion" name="observacion" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        <option value="Programado">Programado</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Completado">Completado</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Crear</button>
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
                    <table id="comites" class="table table-bordered table-hover">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Lugar</th>
                                <th>Observación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'comites_datos.php'; ?>
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
    $(id_comite).ready(function() {
        $('#comites').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
            }
        });
    });

    function cerrarModal() {
        window.location.href = 'comites.php';
    }
</script>

</body>
</html>
