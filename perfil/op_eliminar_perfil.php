<?php
require_once(__DIR__ . '/config/config.php');

session_start();

if ($_SESSION['perfil'] === 'administrador' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    try {
        $consulta = $pdo->prepare("DELETE FROM perfil WHERE id=?");
        $consulta->execute([$id]);
        
        echo "Perfil eliminado correctamente.";
    } catch (PDOException $e) {
        echo "Error al eliminar el perfil: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>
