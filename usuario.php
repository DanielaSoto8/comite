<?php
require_once('config.php');

session_start();

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['permisos'] !== '3') {
    header("Location: index.php");
    exit;
}

// Consulta para obtener todos los usuarios
$consulta_usuarios = $pdo->query("SELECT * FROM usuario");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrar Usuarios</title>
</head>
<body>
    <h2>Administrar Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $consulta_usuarios->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['nombres']; ?></td>
                <td><?php echo $row['apellidos']; ?></td>
                <td>
                    <?php
                    // Consulta para obtener el perfil del usuario
                    $consulta_perfil_usuario = $pdo->prepare("SELECT perfil FROM perfil WHERE id = ?");
                    $consulta_perfil_usuario->execute([$row['id_perfil']]);
                    $perfil_usuario = $consulta_perfil_usuario->fetch(PDO::FETCH_ASSOC);
                    echo $perfil_usuario['perfil'];
                    ?>
                </td>
                <td><?php echo $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                <td>
                    <a href="f_actualizar_usuario.php?id=<?php echo $row['id']; ?>">Actualizar</a>
                    <a href="op_eliminar_usuario.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="f_crear_usuario.php">Crear usuario</a>
</body>
</html>
