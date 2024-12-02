<?php
require_once(__DIR__ . '/config/config.php');

session_start();

// Verificar si el usuario tiene permisos para acceder a esta página
if ($_SESSION['permisos'] !== '3') {
    header("Location: index.php");
    exit;
}

// Verificar si se recibió un ID válido en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de perfil no válido.";
    exit;
}

// Obtener el ID del perfil de la URL
$id = $_GET['id'];

// Realizar la consulta para obtener los datos del perfil
$consulta_perfil = $pdo->prepare("SELECT * FROM perfil WHERE id = ?");
$consulta_perfil->execute([$id]);
$perfil = $consulta_perfil->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró un perfil con el ID proporcionado
if (!$perfil) {
    echo "Perfil no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Perfil</title>
</head>
<body>
    <h2>Actualizar Perfil</h2>
    <form method="post" action="op_actualizar_perfil.php">
        <input type="hidden" name="id" value="<?php echo $perfil['id']; ?>">
        <label for="perfil">Perfil:</label>
        <input type="text" name="perfil" value="<?php echo $perfil['perfil']; ?>" required><br><br>
        
        <label for="lectura">Lectura:</label>
        <input type="checkbox" name="lectura" <?php if ($perfil['lectura'] == 1) echo 'checked'; ?>><br><br>
        
        <label for="escritura">Escritura:</label>
        <input type="checkbox" name="escritura" <?php if ($perfil['escritura'] == 1) echo 'checked'; ?>><br><br>
        
        <label for="administracion">Administración:</label>
        <input type="checkbox" name="administracion" <?php if ($perfil['administracion'] == 1) echo 'checked'; ?>><br><br>
        
        <label for="detalles">Detalles:</label>
        <textarea name="detalles"><?php echo $perfil['detalles']; ?></textarea><br><br>
        
        <label for="estado">Estado:</label>
        <input type="checkbox" name="estado" <?php if ($perfil['estado'] == 1) echo 'checked'; ?>><br><br>
        
        <input type="submit" value="Actualizar Perfil">
    </form>
</body>
</html>
