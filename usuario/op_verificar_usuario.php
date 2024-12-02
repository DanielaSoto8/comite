<?php
require_once('../config/config.php');



if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    $usuario = $_POST['usuario'];

    $consulta = $pdo->prepare(query: "SELECT * FROM usuario WHERE usuario = ?");
    $consulta->execute([$usuario]);

    if ($consulta->rowCount() > 0) {
        echo json_encode(array("mensaje" => "El nombre de usuario ya está en uso.", "existe" => true));
    } else {
        echo json_encode(array("mensaje" => "El nombre de usuario está disponible.", "existe" => false));
    }
}
?>