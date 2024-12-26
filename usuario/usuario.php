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

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['id_perfil'] != 1) {
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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Administrar Usuarios</title>


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
                            <h4 class="m-0 font-weight-bold">Registro de Usuarios</h4>
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
                                        data-toggle="modal" data-target="#modalUsuario">
                                        <i class="fas fa-plus-circle"></i> Ingresar Usuario
                                    </button>
                                </form>
                            </div>

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
                                                    <label for="usuario"
                                                        class="block text-green-700 text-sm font-bold mb-2">usuario</label>
                                                    <input type="text" class="form-control" id="usuario" name="usuario"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contrasenia"
                                                        class="block text-green-700 text-sm font-bold mb-2">Contraseña</label>
                                                    <input type="text" class="form-control" id="contrasenia"
                                                        name="contrasenia" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombres"
                                                        class="block text-green-700 text-sm font-bold mb-2">Nombres</label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="apellidos"
                                                        class="block text-green-700 text-sm font-bold mb-2">Apellidos</label>
                                                    <input type="text" class="form-control" id="apellidos"
                                                        name="apellidos" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo_electronico"
                                                        class="block text-green-700 text-sm font-bold mb-2">Correo
                                                        Electronico</label>
                                                    <input type="text" class="form-control" id="correo_electronico"
                                                        name="correo_electronico" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="id_perfil"
                                                        class="block text-green-700 text-sm font-bold mb-2">Perfil:</label>
                                                    <select name="id_perfil" id="id_perfil" class="form-control"
                                                        required>
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
                                    class="table table-bordered table-striped table-hover text-gray-800 w-full text-sm">
                                    <thead class="bg-green-500 text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo Electronico</th>
                                            <th>Perfil</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
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
                    <h3 class="text-lg font-bold text-red-700">¿Deseas eliminar al usuario <span id="userName"></span>?
                    </h3>
                    <div class="flex justify-end mt-4 gap-4">
                        <button onclick="cerrarModal()"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancelar
                        </button>
                        <form id="deleteForm" method="POST" action="op_eliminar_usuario.php">
                            <input type="hidden" name="usuario" id="deleteUserId">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script de DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
    </script>

    <script>
        $(document).ready(function () {
            $('#table-usuario').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es_es.json"
                },
                "order": [[1, 'asc']],  // Orden por nombre del aprendiz (segunda columna)
                "searching": false,      // Deshabilita el campo de búsqueda
            });

            // Asegúrate de que el modal esté oculto al inicio
            $('#modalUsuario').modal('hide');
        });

        function cerrarModal() {
            window.location.href = 'usuario.php'; // Ocultar el modal
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
                modal.find('#correo_electronico').val(button.data('correo_electronico'));
                modal.find('#id_perfil').val(button.data('id_perfil'));
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
                modal.find('#correo_electronico').val(button.data('correo_electronico'));
                modal.find('#id_perfil').val(button.data(''));
                modal.find('#estado').val(button.data(''));
            }
        });
    </script>
    <script>
        function abrirModalEliminar(usuario, nombre) {
            document.getElementById('deleteUserId').value = usuario;
            document.getElementById('userName').innerText = nombre;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
            window.location.href = 'usuario.php';
        }
    </script>
    <script src="../js/utils.js"></script>
</body>

</html>