<?php
require_once('../config/config.php');

session_start();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    $tipo = (strpos($mensaje, 'Error') !== false) ? 'error' : 'success'; // Determina si el mensaje es de éxito o error
    echo "
    <div id='modal' class='fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center'>
        <div class='bg-white rounded-lg p-6 w-96'>
            <h3 class='text-lg font-bold text-$tipo-700'>$mensaje</h3>
            <button onclick='cerrarModal()' class='mt-4 px-4 py-2 bg-green-600 text-white rounded'>Cerrar</button>
        </div>
    </div>
    <script>
        // Función para cerrar el modal
        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Cerrar el modal después de 3 segundos
        setTimeout(() => {
            document.getElementById('modal').style.display = 'none';
        }, 3000);
    </script>";
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
    <title>Administrar Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex flex-col items-center p-4">
    <h2 class="text-3xl font-bold text-green-700 mb-6">Administrar Usuarios</h2>
    <table class="border-collapse border border-green-600 w-full max-w-4xl text-left">
        <thead>
            <tr class="bg-green-200 text-green-800">
                <th class="border border-green-600 px-4 py-2">ID</th>
                <th class="border border-green-600 px-4 py-2">Usuario</th>
                <th class="border border-green-600 px-4 py-2">Nombres</th>
                <th class="border border-green-600 px-4 py-2">Apellidos</th>
                <th class="border border-green-600 px-4 py-2">Perfil</th>
                <th class="border border-green-600 px-4 py-2">Estado</th>
                <th class="border border-green-600 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $consulta_usuarios->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr class="odd:bg-green-50 even:bg-green-100 text-green-900">
                    <td class="border border-green-600 px-4 py-2"><?php echo $row['id']; ?></td>
                    <td class="border border-green-600 px-4 py-2"><?php echo $row['usuario']; ?></td>
                    <td class="border border-green-600 px-4 py-2"><?php echo $row['nombres']; ?></td>
                    <td class="border border-green-600 px-4 py-2"><?php echo $row['apellidos']; ?></td>
                    <td class="border border-green-600 px-4 py-2">
                        <?php
                        $consulta_perfil_usuario = $pdo->prepare("SELECT perfil FROM perfil WHERE id = ?");
                        $consulta_perfil_usuario->execute([$row['id_perfil']]);
                        $perfil_usuario = $consulta_perfil_usuario->fetch(PDO::FETCH_ASSOC);
                        echo $perfil_usuario['perfil'];
                        ?>
                    </td>
                    <td class="border border-green-600 px-4 py-2"><?php echo $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                    <td class="border border-green-600 px-4 py-2">
                        <a href="f_actualizar_usuario.php?id=<?php echo $row['id']; ?>" class="text-green-500 hover:underline">Actualizar</a>
                        <a href="javascript:void(0);" onclick="mostrarModal(<?php echo $row['id']; ?>)" class="text-red-500 hover:underline ml-2">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="f_crear_usuario.php" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Crear usuario</a>
    <!-- Modal de Confirmación -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4 text-center">¿Estás seguro de que deseas eliminar este usuario?</h2>
        <div class="flex justify-center gap-4">
            <!-- Enlace para confirmar la eliminación -->
            <a id="confirmarEliminar" href="javascript:void(0);" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Eliminar
            </a>
            <button onclick="cerrarModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Cancelar
            </button>
        </div>
    </div>
</div>
</body>
<script>
        // Mostrar el modal
        function mostrarModal(id) {
            document.getElementById('modal').style.display = 'flex'; // Muestra el modal
            // Puedes almacenar el ID del usuario a eliminar en un atributo de data si lo necesitas
            document.getElementById('confirmarEliminar').setAttribute('href', 'op_eliminar_usuario.php?id=' + id);
        }

        // Cerrar el modal sin realizar ninguna acción
        function cerrarModal() {
            document.getElementById('modal').style.display = 'none'; // Ocultar el modal
        }

        // Eliminar usuario
        function eliminarUsuario(id) {
            // Aquí redirigirías a la página de eliminación con el ID del usuario
            window.location.href = 'op_eliminar_usuario.php?id=' + id; // Redirige a op_eliminar.php con el ID del usuario
        }
    </script>

</html>
