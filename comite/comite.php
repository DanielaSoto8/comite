<?php
require_once('../config/config.php');




// Consulta SQL para obtener solo los aprendices con estado 'Notificado'
$query = "SELECT documento_aprendiz, nombre_aprendiz, correo_aprendiz FROM informe WHERE estado = 'Notificado'";

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
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>

                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['documento_aprendiz']; ?></td>
                    <td><?php echo $row['nombre_aprendiz']; ?></td>
                    <td><?php echo $row['correo_aprendiz']; ?></td>
                    <!-- Campo oculto con valor 'Pendiente' -->
                    <td>
                        <input type="hidden" name="estado[]" value="Pendiente">
                        Pendiente
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
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
                <!-- Formulario para crear comité -->
                <form action="procesar_comite.php" method="POST">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
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



<div class="card mt-4 bg-green-100">
    <div class="card-header bg-green-600 text-white">
        <h4>Estudiantes Notificados</h4>
    </div>
    <div class="card-body">
        <table id="estudiantesPendientes" class="table table-bordered table-hover">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>

                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['documento_aprendiz']; ?></td>
                    <td><?php echo $row['nombre_aprendiz']; ?></td>
                    <td><?php echo $row['correo_aprendiz']; ?></td>
                    <!-- Campo oculto con valor 'Pendiente' -->
                    <td>
                        <input type="hidden" name="estado[]" value="Pendiente">
                        Pendiente
                    </td>
                </tr>
            <?php } ?>
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
<script>
    $(document).ready(function() {
        $('#estudiantesPendientes').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
            }
        });
    });
</script>

</body>
</html>
