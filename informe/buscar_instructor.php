<?php
require_once('../config/config.php'); 

if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    $stmt = $pdo->prepare("SELECT documento, nombres, correo_electronico FROM instructor WHERE documento LIKE :documento LIMIT 10");
    $stmt->execute([':documento' => "%$documento%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultados);
}
?>
