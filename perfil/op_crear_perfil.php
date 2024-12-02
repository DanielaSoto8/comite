<?php
require_once(__DIR__ . '/config/config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['permisos'] === '3') {
    $perfil = $_POST['perfil'];
    $lectura = isset($_POST['lectura']) ? $_POST['lectura'] : 0;
    $escritura = isset($_POST['escritura']) ? $_POST['escritura'] : 0;
    $administracion = isset($_POST['administracion']) ? $_POST['administracion'] : 0;
    $detalles = $_POST['detalles'];
    $permisos = $lectura + $escritura + $administracion;

    try {
        $consulta = $pdo->prepare("INSERT INTO perfil (perfil, lectura, escritura, administracion, detalles, permisos, estado) VALUES (?, ?, ?, ?, ?, ?, 1)");
        $consulta->execute([$perfil, $lectura, $escritura, $administracion, $detalles, $permisos]);
        
        echo "Perfil creado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al crear perfil: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
