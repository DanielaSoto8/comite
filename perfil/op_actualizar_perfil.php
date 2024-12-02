<?php
require_once(__DIR__ . '/config/config.php');

session_start();

if ($_SESSION['perfil'] === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $perfil = $_POST['perfil'];
    $lectura = isset($_POST['lectura']) ? 1 : 0;
    $escritura = isset($_POST['escritura']) ? 1 : 0;
    $administracion = isset($_POST['administracion']) ? 1 : 0;
    $detalles = $_POST['detalles'];
    $estado = isset($_POST['estado']) ? 1 : 0;

    try {
        $consulta = $pdo->prepare("UPDATE perfil SET perfil=?, lectura=?, escritura=?, administracion=?, detalles=?, estado=? WHERE id=?");
        $consulta->execute([$perfil, $lectura, $escritura, $administracion, $detalles, $estado, $id]);
        
        echo "Perfil actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar el perfil: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
