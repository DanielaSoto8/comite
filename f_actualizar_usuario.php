<?php
require_once('config.php');

session_start();

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['permisos'] !== '3') {
    header("Location: index.php");
    exit;
}

// Verificar si se recibió un ID válido en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de usuario no válido.";
    exit;
}

// Obtener el ID del usuario de la URL
$id = $_GET['id'];

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
<html>
<head>
    <title>Actualizar Usuario</title>
</head>
<body>
    <h2>Actualizar Usuario</h2>
    <form method="post" action="op_actualizar_usuario.php">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" value="<?php echo $usuario['usuario']; ?>" required><br><br>
        
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" value="<?php echo $usuario['nombres']; ?>" required><br><br>
        
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required><br><br>
        
        <label for="perfil">Perfil:</label>
        <select name="perfil" required>
            <option value="">Seleccione un perfil</option>
            <?php
            // Consulta para obtener todos los perfiles
            $consulta_perfiles = $pdo->query("SELECT id, perfil FROM perfil");
            while ($row = $consulta_perfiles->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$row['id']."' ".($row['id'] == $usuario['id_perfil'] ? 'selected' : '').">".$row['perfil']."</option>";
            }
            ?>
        </select><br><br>
        
        <label for="estado">Estado:</label>
        <input type="checkbox" name="estado" <?php if ($usuario['estado'] == 1) echo 'checked'; ?>><br><br>
        
        <input type="submit" value="Actualizar Usuario">
    </form>
</body>
</html>
