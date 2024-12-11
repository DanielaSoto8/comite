<?php
require_once('../config/config.php');

// Iniciar sesión
session_start();

// Verificar si el usuario tiene permisos para acceder a esta página
if (!isset($_SESSION['id_perfil']) || $_SESSION['id_perfil'] != 1) {
    header("Location: usuario.php");
    exit;
}

// Mostrar el mensaje de éxito si existe en la sesión
if (isset($_SESSION['mensaje'])) {
    echo "<div class='bg-green-500 text-white px-4 py-2 rounded mb-4'>" . $_SESSION['mensaje'] . "</div>";
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['mensaje'] . "');
          </script>";
    unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
}

// Verificar si se recibió un ID válido en la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || empty($_GET['id'])) {
    echo "ID de usuario no válido.";
    exit;
}

// Obtener el ID del usuario de la URL
$id = (int) $_GET['id'];

// Realizar la consulta para obtener los datos del usuario
$consulta_usuario = $pdo->prepare("SELECT * FROM usuario WHERE id = ?");
$consulta_usuario->execute([$id]);
$usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró un usuario con el ID proporcionado
if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen flex flex-col items-center p-6">
    <h2 class="text-3xl font-bold text-green-700 mb-6">Actualizar Usuario</h2>
    <form method="post" action="op_actualizar_usuario.php" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">

        <!-- Campo Usuario -->
        <div class="mb-4">
            <label for="usuario" class="block text-green-700 text-sm font-bold mb-2">Usuario:</label>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Nombres -->
        <div class="mb-4">
            <label for="nombres" class="block text-green-700 text-sm font-bold mb-2">Nombres:</label>
            <input type="text" name="nombres" value="<?php echo htmlspecialchars($usuario['nombres']); ?>" required 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Apellidos -->
        <div class="mb-4">
            <label for="apellidos" class="block text-green-700 text-sm font-bold mb-2">Apellidos:</label>
            <input type="text" name="apellidos" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>
        <div class="mb-4">
            <label for="correo_electronico" class="block text-green-700 text-sm font-bold mb-2">Correo Electronico:</label>
            <input type="text" name="correo_electronico" value="<?php echo htmlspecialchars($usuario['correo_electronico']); ?>" required 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Campo Perfil -->
        <div class="mb-4">
            <label for="perfil" class="block text-green-700 text-sm font-bold mb-2">Perfil:</label>
            <select name="perfil" required 
                class="block appearance-none w-full bg-white border border-green-300 rounded py-2 px-3 text-green-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Seleccione un perfil</option>
                <?php
                $consulta_perfiles = $pdo->query("SELECT id, perfil FROM perfil");
                while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='".$row['id']."' ".($row['id'] == $usuario['id_perfil'] ? 'selected' : '').">".htmlspecialchars($row['perfil'])."</option>";
                }
                ?>
            </select>
        </div>

        <!-- Campo Estado -->
        <div class="mb-4">
            <label for="estado" class="inline-flex items-center text-green-700 text-sm font-bold">
                <input type="checkbox" name="estado" class="mr-2 leading-tight" <?php if ($usuario['estado'] == 1) echo 'checked'; ?>>
                Activo
            </label>
        </div>

        <!-- Botón Actualizar -->
        <div class="flex items-center justify-between">
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Actualizar Usuario
            </button>
        </div>
    </form>
</body>
</html>
