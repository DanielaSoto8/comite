<?php
require_once ('config.php');

session_start();

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['permisos'] !== '3') {
    header("Location: index.php");
    exit;
}

// Consulta para obtener todos los perfiles
$consulta_perfiles = $pdo->query("SELECT * FROM perfil");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Administrar Perfiles</title>
</head>

<body>
    <h2>Administrar Perfiles</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Perfil</th>
            <th>Lectura</th>
            <th>Escritura</th>
            <th>Administración</th>
            <th>Detalles</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['perfil']; ?></td>
                <td><?php echo $row['lectura']; ?></td>
                <td><?php echo $row['escritura']; ?></td>
                <td><?php echo $row['administracion']; ?></td>
                <td><?php echo $row['detalles']; ?></td>
                <td><?php echo $row['estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                <td>
                    <a href="f_actualizar_perfil.php?id=<?php echo $row['id']; ?>">Actualizar</a>
                    <a href="op_eliminar_perfil.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if ($_SESSION['permisos'] === '3'): ?>
        <a href="f_crear_perfil.php">Crear Perfil</a>
    <?php endif; ?>
</body>

</html>