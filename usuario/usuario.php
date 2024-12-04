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
            <button onclick='cerrarModalInfo()' class='mt-4 px-4 py-2 bg-green-600 text-white rounded'>Cerrar</button>
        </div>
    </div>";
}

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['id_perfil'] != 3) {
    header("Location: ../index.php");
    exit;
}

// Consulta para obtener todos los usuarios
$consulta_usuarios = $pdo->query("SELECT * FROM usuario");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <title>Administrar Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
                            <h4 class="m-0 font-weight-bold">Administrar Usuarios</h4>
                        </div>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <div class="mb-4">
                        <h4 class="text-green-700">Buscar Registros</h4>
                        <form action="buscar.php" method="GET" class="form-inline">
                            <div class="form-group mb-2">
                                <label for="buscar" class="sr-only">Ingrese su búsqueda</label>
                                <input type="text" id="buscar" name="buscar" class="form-control"
                                    placeholder="Buscar por nombre" required>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </form>

                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn bg-green-600 hover:bg-green-700 text-white" data-toggle="modal"
                            data-target="#modalUsuario">
                            <i class="fas fa-plus-circle"></i> Ingresar Usuario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-green-600 text-white">
                                        <h5 class="modal-title" id="modalUsuarioLabel">Ingresar Usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-green-50">
                                        <form method="POST">
                                            <input type="hidden" id="id" name="id">
                                            <div class="form-group">
                                                <label for="usuario">usuario</label>
                                                <input type="text" class="form-control" id="usuario" name="usuario"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="contrasenia">Contraseña</label>
                                                <input type="text" class="form-control" id="contrasenia"
                                                    name="contrasenia" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombres">Nombres</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellidos">Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="perfil"
                                                    class="block text-green-700 text-sm font-bold mb-2">Perfil:</label>
                                                <select name="perfil" id="perfil" class="form-control" required>
                                                    <option value="">Seleccione un perfil</option>
                                                    <?php
                                                    // Consulta para obtener los perfiles
                                                    $consulta_perfiles = $pdo->query("SELECT id, perfil FROM perfil");
                                                    while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['perfil']) . "</option>";
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <!-- Campo Estado -->
                                            <div class="mb-4">
                                                <label for="estado"
                                                    class="inline-flex items-center text-green-700 text-sm font-bold">
                                                    Estado
                                                </label>
                                                <select class="form-control" id="jornada" name="estado" required>
                                                    <option value="activo">Activo</option>
                                                    <option value="inactivo">Inactivo</option>
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
                            <table id="table-usuario"
                                class="table table-bordered table-striped table-hover text-gray-800">
                                <thead class="bg-green-500 text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>contraseña</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Incluye el archivo PHP donde se consulta la base de datos y se muestran los registros
                                    include 'usuarios_datos.php';
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="confirmModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-red-700">¿Deseas eliminar al usuario <span id="userName"></span>?</h3>
                <div class="flex justify-end mt-4 gap-4">
                    <button onclick="cerrarModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                    <form id="deleteForm" method="POST" action="op_eliminar_usuario.php">
                        <input type="hidden" name="id" id="deleteUserId">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="content">


            <!-- Enlaces a los scripts de Bootstrap, jQuery, Ruang Admin y DataTables -->
            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="../js/ruang-admin.min.js"></script>
            <!-- Script de DataTables -->
            <script type="text/javascript" charset="utf8"
                src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function () {
                    // Inicializa DataTables con opciones de búsqueda y ordenamiento
                    $('#table-usuario').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                        },
                        "order": [[1, 'asc']]  // Orden por nombre del usuario (segunda columna)
                    });

                    // Asegúrate de que el modal esté oculto al inicio (esto lo hace Bootstrap por defecto, pero es una verificación extra)
                    $('#modalUsuario').modal('hide');
                });

                function cerrarModal() {
                    window.location.href = 'usuario.php'; // Ocultar el modal
                    // Ocultar el modal
                }
            </script>

            <script>
                $('#modalUsuario').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget); // Botón que activó el modal
                    var modal = $(this);

                    if (button.hasClass('btn-editar')) {
                        // Si es un botón de editar, configuramos el modal para editar
                        modal.find('.modal-title').text('Editar Usuario');
                        modal.find('form').attr('action', 'op_actualizar_usuario.php');

                        // Llenamos los campos con los datos del usuario
                        modal.find('#id').val(button.data('id'));
                        modal.find('#usuario').val(button.data('usuario'));
                        modal.find('#contrasenia').val(button.data('contrasenia'));
                        modal.find('#nombres').val(button.data('nombres'));
                        modal.find('#apellidos').val(button.data('apellidos'));
                        modal.find('#perfil').val(button.data('perfil'));
                        modal.find('#estado').val(button.data('estado'));




                    } else {
                        // Si es un botón de crear, configuramos el modal para crear
                        modal.find('.modal-title').text('Ingresar Usuario');
                        modal.find('form').attr('action', 'op_crear_usuario.php');

                        // Limpiamos los campos del formulario
                        modal.find('#usuario').val(button.data(''));
                        modal.find('#contrasenia').val(button.data(''));
                        modal.find('#nombres').val(button.data(''));
                        modal.find('#apellidos').val(button.data(''));
                        modal.find('#perfil').val(button.data(''));
                        modal.find('#estado').val(button.data(''));
                    }
                });
            </script>
            <script>
                function abrirModalEliminar(id, nombre) {
                    document.getElementById('deleteUserId').value = id;
                    document.getElementById('userName').innerText = nombre;
                    document.getElementById('confirmModal').style.display = 'flex';
                }

                function cerrarModal() {
                    document.getElementById('confirmModal').style.display = 'none';
                }

                function cerrarModalInfo() {
                    document.getElementById('modal').style.display = 'none';
                    window.location.href = 'usuario.php';
                }
            </script>
           <script src="../js/utils.js"></script>



</body>

</html>